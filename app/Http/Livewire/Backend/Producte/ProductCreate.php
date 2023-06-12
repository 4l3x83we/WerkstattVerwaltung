<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: ProductCreate.php
 * User: ${USER}
 * Date: 08.${MONTH_NAME_FULL}.2023
 * Time: 09:26
 */

namespace App\Http\Livewire\Backend\Producte;

use App\Models\Admin\Settings\CompanySettings;
use App\Models\Backend\Product\Category;
use App\Models\Backend\Product\PriceGroup;
use App\Models\Backend\Product\Products;
use App\Models\Backend\Product\Stock;
use App\Models\Backend\Upload\Upload;
use Carbon\Carbon;
use File;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductCreate extends Component
{
    use WithFileUploads;

    public $products = [
        'product_mwst' => 19,
        'product_price_netto_ek' => null,
        'product_price_netto_vk' => null,
        'product_price_brutto_vk' => null,
        'no_warehouse_management' => false,
    ];

    public $price_groups = [
        'priceGroup_price_vk_2' => null,
        'priceGroup_price_vk_3' => null,
        'priceGroup_price_vk_4' => null,
        'priceGroup_price_vk_5' => null,
        'priceGroup_price_vk_brutto_2' => null,
        'priceGroup_price_vk_brutto_3' => null,
        'priceGroup_price_vk_brutto_4' => null,
        'priceGroup_price_vk_brutto_5' => null,
    ];

    public $stock;

    public $category;

    public $json;

    public $allCategories;

    public $image;

    public $priceNettoBrutto = false;

    protected $messages = [
        'products.product_artnr.required' => 'Artikelnummer muss ausgefüllt werden.',
        'products.product_name.required' => 'Artikelname muss ausgefüllt werden.',
        'products.product_einheit.required' => 'Einheit muss ausgefüllt werden.',
        'products.product_price_netto_vk.required' => 'Verkaufspreis Netto muss ausgefüllt werden.',
        'products.product_mwst.required' => 'MwSt muss ausgefüllt werden.',
        'products.product_price_brutto_vk.required' => 'Verkaufspreis Brutto muss ausgefüllt werden.',
        'products.product_qty.required' => 'Aktueller Bestand muss ausgefüllt werden.',
        'products.category_id.required' => 'Kategorie muss ausgefüllt werden.',
    ];

    protected $rules = [
        'products.id' => 'nullable',
        'products.product_artnr' => 'required',
        'products.product_name' => 'required',
        'products.product_name_zusatz' => 'nullable',
        'products.product_ean' => 'nullable|max:13',
        'products.product_ersetzung' => 'nullable',
        'products.product_einheit' => 'required',
        'products.product_hersteller' => 'nullable',
        'products.product_price_netto_ek' => 'nullable',
        'products.product_price_netto_vk' => 'required',
        'products.product_mwst' => 'required',
        'products.product_price_brutto_vk' => 'required',
        'products.product_notes' => 'nullable',
        'products.product_not_price_update' => 'nullable',
        'products.product_qty' => 'required',
        'products.product_desc' => 'nullable',
        'products.price_netto_brutto' => 'nullable',

        'category.category_id' => 'required',

        'stock.stock_reserved' => 'nullable',
        'stock.stock_available' => 'nullable',
        'stock.stock_movement_qty' => 'nullable',
        'stock.stock_movement_date' => 'nullable',
        'products.no_warehouse_management' => 'nullable',
        'stock.storage_location' => 'nullable',
        'stock.minimum_amount' => 'nullable',
        'stock.maximum_amount' => 'nullable',
        'stock.stock_movement_note' => 'nullable',

        'price_groups.priceGroup_price_vk_1' => 'nullable',
        'price_groups.priceGroup_price_vk_2' => 'nullable',
        'price_groups.priceGroup_price_vk_3' => 'nullable',
        'price_groups.priceGroup_price_vk_4' => 'nullable',
        'price_groups.priceGroup_price_vk_5' => 'nullable',
        'price_groups.priceGroup_price_vk_brutto_1' => 'nullable',
        'price_groups.priceGroup_price_vk_brutto_2' => 'nullable',
        'price_groups.priceGroup_price_vk_brutto_3' => 'nullable',
        'price_groups.priceGroup_price_vk_brutto_4' => 'nullable',
        'price_groups.priceGroup_price_vk_brutto_5' => 'nullable',
        'price_groups.priceGroup_marge_1' => 'nullable',
        'price_groups.priceGroup_marge_2' => 'nullable',
        'price_groups.priceGroup_marge_3' => 'nullable',
        'price_groups.priceGroup_marge_4' => 'nullable',
        'price_groups.priceGroup_marge_5' => 'nullable',

        'image' => 'nullable',
    ];

    public function mount()
    {
        $this->allCategories = Category::whereNull('parent_id')->with('childCategories')->get();
        $this->stock['stock_movement_date'] = Carbon::parse(now())->format('Y-m-d');
        $this->stock['stock_movement_note'] = 'Artikel angelegt';
    }

    // Change Netto Preis oder Brutto Preis
    public function updatedProductsPriceNettoBrutto()
    {
        if ($this->products['price_netto_brutto']) {
            $this->priceNettoBrutto = true;
            $this->updatedPriceGroupsPriceGroupPriceVk1();
        } else {
            $this->priceNettoBrutto = false;
            $this->updatedProductsProductPriceBruttoVk();
        }
    }

    // Berechnung der Verkaufspreis Brutto
    public function updatedProductsProductPriceBruttoVk()
    {
        $mwst = $this->price()['mwst'];
        $brutto = $this->price()['bruttoVK'];
        $this->products['product_price_brutto_vk'] = number_format($brutto, 2);
        $this->products['product_price_netto_vk'] = number_format(round($brutto, 2) / $mwst, 2);
        $this->price_groups['priceGroup_price_vk_1'] = $this->price()['nettoVK'];
        $this->price_groups['priceGroup_price_vk_brutto_1'] = $this->price()['bruttoVK'];
        if (isset($this->price()['nettoEK'])) {
            $this->updatedProductsProductPriceNettoEk();
        }
    }

    // Preise zusammentragen
    public function price()
    {
        return [
            'nettoEK' => $this->products['product_price_netto_ek'] === '' ? null : $this->products['product_price_netto_ek'],
            'nettoVK' => $this->products['product_price_netto_vk'] === '' ? null : $this->products['product_price_netto_vk'],
            'bruttoVK' => $this->products['product_price_brutto_vk'] === '' ? null : $this->products['product_price_brutto_vk'],
            'mwst' => $this->products['product_mwst'] === '' ? null : mwst($this->products['product_mwst']),
            'nettoVKPg2' => $this->price_groups['priceGroup_price_vk_2'] === '' ? null : $this->price_groups['priceGroup_price_vk_2'],
            'nettoVKPg3' => $this->price_groups['priceGroup_price_vk_3'] === '' ? null : $this->price_groups['priceGroup_price_vk_3'],
            'nettoVKPg4' => $this->price_groups['priceGroup_price_vk_4'] === '' ? null : $this->price_groups['priceGroup_price_vk_4'],
            'nettoVKPg5' => $this->price_groups['priceGroup_price_vk_5'] === '' ? null : $this->price_groups['priceGroup_price_vk_5'],
        ];
    }

    // Eingabe Netto Einkaufspreis
    public function updatedProductsProductPriceNettoEk()
    {
        if (isset($this->price()['nettoEK'])) {
            if (isset($this->products['product_price_netto_vk'])) {
                $marge = (($this->price()['nettoVK'] - $this->price()['nettoEK']) / $this->price()['nettoEK']) * 100;
                $this->price_groups['priceGroup_marge_1'] = number_format($marge, 2);
            }
            if (isset($this->price_groups['priceGroup_price_vk_2'])) {
                $this->updatedPriceGroupsPriceGroupPriceVk2();
            }
            if (isset($this->price_groups['priceGroup_price_vk_3'])) {
                $this->updatedPriceGroupsPriceGroupPriceVk3();
            }
            if (isset($this->price_groups['priceGroup_price_vk_4'])) {
                $this->updatedPriceGroupsPriceGroupPriceVk4();
            }
            if (isset($this->price_groups['priceGroup_price_vk_5'])) {
                $this->updatedPriceGroupsPriceGroupPriceVk5();
            }
            $this->products['product_price_netto_ek'] = number_format($this->price()['nettoEK'], 2);
        }
    }

    // Berechnung der Verkaufspreise für die Preisgruppe 2
    public function updatedPriceGroupsPriceGroupPriceVk2()
    {
        $mwst = $this->price()['mwst'];
        $netto = $this->price()['nettoVKPg2'];
        $this->price_groups['priceGroup_price_vk_2'] = number_format($netto, 2);
        $this->price_groups['priceGroup_price_vk_brutto_2'] = number_format(round($netto, 2) * $mwst, 2);
        if (isset($this->price()['nettoEK'])) {
            $marge = (($this->price()['nettoVKPg2'] - $this->price()['nettoEK']) / $this->price()['nettoEK']) * 100;
            $this->price_groups['priceGroup_marge_2'] = number_format($marge, 2);
        }
    }

    // Berechnung der Verkaufspreise für die Preisgruppe 3
    public function updatedPriceGroupsPriceGroupPriceVk3()
    {
        if (isset($this->price_groups['priceGroup_price_vk_3'])) {
            $mwst = $this->price()['mwst'];
            $netto = $this->price()['nettoVKPg3'];
            $this->price_groups['priceGroup_price_vk_3'] = number_format($netto, 2);
            $this->price_groups['priceGroup_price_vk_brutto_3'] = number_format(round($netto, 2) * $mwst, 2);
            if (isset($this->price()['nettoEK'])) {
                $marge = (($this->price()['nettoVKPg3'] - $this->price()['nettoEK']) / $this->price()['nettoEK']) * 100;
                $this->price_groups['priceGroup_marge_3'] = number_format($marge, 2);
            }
        }
    }

    // Berechnung der Verkaufspreise für die Preisgruppe 4
    public function updatedPriceGroupsPriceGroupPriceVk4()
    {
        $mwst = $this->price()['mwst'];
        $netto = $this->price()['nettoVKPg4'];
        $this->price_groups['priceGroup_price_vk_4'] = number_format($netto, 2);
        $this->price_groups['priceGroup_price_vk_brutto_4'] = number_format(round($netto, 2) * $mwst, 2);
        if (isset($this->price()['nettoEK'])) {
            $marge = (($this->price()['nettoVKPg4'] - $this->price()['nettoEK']) / $this->price()['nettoEK']) * 100;
            $this->price_groups['priceGroup_marge_4'] = number_format($marge, 2);
        }
    }

    // Berechnung der Verkaufspreise für die Preisgruppe 5
    public function updatedPriceGroupsPriceGroupPriceVk5()
    {
        $mwst = $this->price()['mwst'];
        $netto = $this->price()['nettoVKPg5'];
        $this->price_groups['priceGroup_price_vk_5'] = number_format($netto, 2);
        $this->price_groups['priceGroup_price_vk_brutto_5'] = number_format(round($netto, 2) * $mwst, 2);
        if (isset($this->price()['nettoEK'])) {
            $marge = (($this->price()['nettoVKPg5'] - $this->price()['nettoEK']) / $this->price()['nettoEK']) * 100;
            $this->price_groups['priceGroup_marge_5'] = number_format($marge, 2);
        }
    }

    // MwSt Auswahl
    public function updatedProductsProductMwst()
    {
        if (empty($this->products['price_netto_brutto'])) {
            $this->updatedProductsProductPriceNettoVk();
            if ($this->price_groups['priceGroup_price_vk_2']) {
                $this->updatedPriceGroupsPriceGroupPriceVk2();
            } elseif ($this->price_groups['priceGroup_price_vk_3']) {
                $this->updatedPriceGroupsPriceGroupPriceVk3();
            } elseif ($this->price_groups['priceGroup_price_vk_4']) {
                $this->updatedPriceGroupsPriceGroupPriceVk4();
            } elseif ($this->price_groups['priceGroup_price_vk_5']) {
                $this->updatedPriceGroupsPriceGroupPriceVk5();
            }
        } else {
            $this->updatedProductsProductPriceBruttoVk();
        }
    }

    // Berechnung des Verkaufspreis Netto
    public function updatedProductsProductPriceNettoVk()
    {
        $mwst = $this->price()['mwst'];
        $netto = $this->price()['nettoVK'];
        $this->products['product_price_netto_vk'] = number_format($netto, 2);
        $this->products['product_price_brutto_vk'] = number_format(round($netto, 2) * $mwst, 2);
        $this->price_groups['priceGroup_price_vk_1'] = $this->price()['nettoVK'];
        $this->price_groups['priceGroup_price_vk_brutto_1'] = $this->price()['bruttoVK'];
        if (isset($this->price()['nettoEK'])) {
            $this->updatedProductsProductPriceNettoEk();
        }
    }

    public function updatedProductsProductQty()
    {
        $this->stock['stock_available'] = $this->products['product_qty'];
        $this->stock['stock_movement_qty'] = $this->products['product_qty'];
    }

    public function store()
    {
        $validatedData = $this->validate();
        foreach ($validatedData['category'] as $category) {
            $categoryIds = $category;
        }
        $product = Products::create($validatedData['products']);
        $product->category()->sync($categoryIds);
        $validatedData['price_groups']['product_id'] = $product->id;
        $validatedData['stock']['product_id'] = $product->id;
        Stock::create($validatedData['stock']);
        PriceGroup::create($validatedData['price_groups']);
        if ($this->image) {
            $path = 'produkte/'.$product->id;
            $image = Upload::create(uploadImages($this->image, $path));
            $this->products->uploads()->attach($image->id);
        }

        session()->flash('success', 'Das Produkt '.$product->product_name.' wurde erfolgreich angelegt.');

        return redirect(route('backend.produkte.index'));
    }

    public function render()
    {
        $jsonFile = File::get('assets/json/arrays.json');
        $dataJson = json_decode($jsonFile);
        $json = [];
        foreach ($dataJson as $key => $jsonKey) {
            $json[$key] = $jsonKey;
        }
        $this->json = $json;
        $this->products['mwst'] = $this->mwstWerte();

        return view('livewire.backend.producte.product-create');
    }

    public function mwstWerte()
    {
        $tax = CompanySettings::select(['tax_rate_full', 'tax_rate_reduced', 'tax_rate_free', 'tax_rate_core'])->latest()->first();

        return [
            [
                'wert' => $tax->tax_rate_full,
                'name' => 'volle MwSt',
            ],
            [
                'wert' => $tax->tax_rate_reduced,
                'name' => 'verm. MwSt',
            ],
            [
                'wert' => $tax->tax_rate_free,
                'name' => 'MwSt frei',
            ],
            [
                'wert' => $tax->tax_rate_core,
                'name' => 'AT.-MwSt',
            ],
        ];
    }
}
