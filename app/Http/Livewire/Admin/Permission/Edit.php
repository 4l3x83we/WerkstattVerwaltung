<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Edit.php
 * User: ${USER}
 * Date: 23.${MONTH_NAME_FULL}.2023
 * Time: 08:42
 */

namespace App\Http\Livewire\Admin\Permission;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Edit extends Component
{
    public $permission;

    protected $messages = [
        'permission.name.require' => 'Name muss ausgefüllt sein.',
        'permission.name.unique' => 'Die Berechtigung ist bereits vergeben.',
    ];

    public function rules()
    {
        return [
            'permission.name' => ['required', 'unique:permissions,name'],
        ];
    }

    public function mount($id)
    {
        $this->permission = Permission::findOrFail($id);
    }

    public function update()
    {
        $this->permission->update($this->validate());

        session()->flash('success', 'Die Berechtigung: '.$this->permission['name'].' wurde geändert.');

        return redirect(route('admin.permission.index'));
    }

    public function render()
    {
        return view('livewire.admin.permission.edit');
    }
}
