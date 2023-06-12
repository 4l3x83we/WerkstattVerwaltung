<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: ProductEdit.php
 * User: ${USER}
 * Date: 08.${MONTH_NAME_FULL}.2023
 * Time: 09:25
 */

namespace App\Http\Livewire\Backend\Producte;

use App\Models\Admin\Settings\CompanySettings;
use App\Models\Backend\Product\Category;
use App\Models\Backend\Product\Stock;
use App\Models\Backend\Upload\Upload;
use Carbon\Carbon;
use File;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductEdit extends Component
{
    use WithFileUploads;

    public $products;

    public $price_groups;

    public $stock;

    public $category;

    public $json;

    public $allCategories;

    public $categories;

    public $image;

    public $stockMovements;

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
        'products.no_warehouse_management' => 'nullable',
        'stock.storage_location' => 'nullable',
        'stock.minimum_amount' => 'nullable',
        'stock.maximum_amount' => 'nullable',

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

    public function mount($produkte)
    {
        $this->products = $produkte;
        $this->stock = $produkte->stocks()->latest()->first();
        $this->price_groups = $produkte->priceGroups()->first();
        $this->allCategories = Category::whereNull('parent_id')->orderBy('category_title', 'ASC')->with('childCategories.childCategories')->get();
        foreach ($produkte->category as $category) {
            $this->category['category_id'] = $category->id;
        }
        $this->stockMovements = $produkte->stocks()->get();
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
        $qty = $this->products['product_qty'];
        if ($this->stock) {
            $available = $this->stock['stock_available'];
            $this->stock['stock_available'] = $qty;
            if ($this->products['product_qty'] === $this->stock->stock_available) {
                Stock::create(['product_id' => $this->products->id, 'stock_movement_date' => Carbon::parse(now())->format('Y-m-d'), 'stock_available' => $qty, 'stock_movement_qty' => $qty - $available, 'stock_movement_note' => 'Lagerbestand manuell angepasst.', 'storage_location' => $this->stock['storage_location']]);
                $this->products->update(['product_qty' => $qty]);
                session()->flash('success', 'Der Lagerbestand wurde angepasst.');

                return redirect(route('backend.produkte.index'));
            }
        } else {
            $this->products->update(['product_qty' => $qty]);
            session()->flash('success', 'Der Bestand wurde angepasst.');

            return redirect(route('backend.produkte.index'));
        }
    }

    public function updatedProductsNoWarehouseManagement()
    {
        if ($this->products['no_warehouse_management']) {
            $this->products->update([
                'no_warehouse_management' => true,
            ]);

            redirect(request()->header('Referer'));
        } else {
            $this->products->update([
                'no_warehouse_management' => false,
            ]);

            redirect(request()->header('Referer'));
        }
    }

    public function updatedImage()
    {
        if ($this->image) {
            $path = 'produkte/'.$this->products->id;
            $image = Upload::create(uploadImages($this->image, $path));
            $this->products->uploads()->attach($image->id);
            session()->flash('success', 'Die Bilder wurden zum Produkt: '.$this->products->product_name.' hinzugefügt.');

            redirect(request()->header('Referer'));
        }
    }

    public function store()
    {
        $validatedData = $this->validate();
        dd($validatedData);
        foreach ($validatedData['category'] as $category) {
            $categoryIds = $category;
        }
        $this->products->update($validatedData['products']);
        $this->products->category()->sync($categoryIds);
        $validatedData['price_groups']['product_id'] = $this->products->id;
        $this->price_groups->update($validatedData['price_groups']);
        if ($this->stock) {
            $this->stock->update([
                'no_warehouse_management' => $this->stock['no_warehouse_management'],
                'storage_location' => $this->stock['storage_location'],
                'minimum_amount' => $this->stock['minimum_amount'],
                'maximum_amount' => $this->stock['maximum_amount'],
            ]);
        }

        session()->flash('success', 'Das Produkt '.$this->products->product_name.' wurde geändert.');

        return redirect(route('backend.produkte.index'));
    }

    public function destroyPicture($id)
    {
        $image = Upload::where('id', $id)->first();
        if (File::exists($image->filepath)) {
            File::delete($image->filepath);
            $this->products->uploads()->detach($image->id);
            $image->delete();
            session()->flash('successError', 'Das Bild wurde gelöscht.');

            redirect(request()->header('Referer'));
        } else {
            session()->flash('info', 'Das Bild konnte nicht gelöscht.');

            return redirect()->back();
        }

        return redirect()->back();
    }

    public function destroyAllPicture($productID)
    {
        $path = 'images/produkte/'.$productID;
        if (File::exists($path)) {
            File::deleteDirectory($path);
            foreach ($this->products->uploads as $image) {
                $this->products->uploads()->detach($image->id);
                $image->delete();
            }
            session()->flash('successError', 'Die Bilder wurden gelöscht.');

            redirect(request()->header('Referer'));
        } else {
            session()->flash('info', 'Die Bilder konnte nicht gelöscht werden.');

            return redirect()->back();
        }

        return redirect()->back();
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
        if (isset($this->price()['nettoEK'])) {
            $this->updatedProductsProductPriceNettoEk();
        }

        return view('livewire.backend.producte.product-edit');
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
