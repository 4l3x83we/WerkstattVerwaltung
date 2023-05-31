<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Create.php
 * User: ${USER}
 * Date: 23.${MONTH_NAME_FULL}.2023
 * Time: 08:42
 */

namespace App\Http\Livewire\Admin\Permission;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Create extends Component
{
    public $name;

    public function create()
    {
        $this->validate([
            'name' => ['required', 'unique:'.Permission::class],
        ], [
            'name.require' => 'Name muss ausgefüllt sein.',
            'name.unique' => 'Die Berechtigung ist bereits vergeben.',
        ]);
        Permission::create(['name' => $this->name]);

        session()->flash('success', 'Die Berechtigung: '.$this->name.' wurde angelegt.');

        return redirect(route('admin.permission.index'));
    }

    public function render()
    {
        return view('livewire.admin.permission.create');
    }
}
