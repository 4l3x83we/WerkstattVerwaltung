<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Create.php
 * User: ${USER}
 * Date: 23.${MONTH_NAME_FULL}.2023
 * Time: 08:42
 */

namespace App\Http\Livewire\Admin\Role;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    public $permissions;

    public $name;

    public $permission;

    protected $messages = [
        'name.require' => 'Name muss ausgefüllt sein.',
        'name.unique' => 'Die Role ist bereits vergeben.',
    ];

    public function rules()
    {
        return [
            'name' => ['required', 'unique:'.Role::class],
            'permission' => 'required',
        ];
    }

    public function create()
    {
        $role = Role::create(['name' => $this->name]);
        $role->givePermissionTo($this->permission);

        session()->flash('success', 'Die Rolle: '.$this->name.' wurde angelegt.');

        return redirect(route('admin.roles.index'));
    }

    public function mount()
    {
        $this->permissions = Permission::all();
    }

    public function render()
    {
        return view('livewire.admin.role.create');
    }
}
