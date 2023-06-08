<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: KategorieShow.php
 * User: ${USER}
 * Date: 08.${MONTH_NAME_FULL}.2023
 * Time: 07:01
 */

namespace App\Http\Livewire\Backend\Kategorie;

use Livewire\Component;

class KategorieShow extends Component
{
    public $category;

    public function mount($kategorie)
    {
        $this->category = $kategorie;
    }

    public function render()
    {
        return view('livewire.backend.kategorie.kategorie-show');
    }
}
