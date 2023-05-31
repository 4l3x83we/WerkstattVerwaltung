<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Show.php
 * User: ${USER}
 * Date: 23.${MONTH_NAME_FULL}.2023
 * Time: 08:42
 */

namespace App\Http\Livewire\Admin\Role;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Show extends Component
{
    public $role;

    public $permissions;

    public $rolePermissions;

    public $permissionCheck;

    public $updateMode = false;

    public function rules()
    {
        return [
            'role.name' => 'required',
            'permissionCheck' => 'nullable',
        ];
    }

    public function mount($id)
    {
        $this->role = Role::with('permissions')->findOrFail($id);
        $this->permissions = Permission::all();
        $this->permissionCheck = $this->role->permissions->pluck('name')->toArray();
        $this->rolePermissions = $this->role->permissions;
    }

    public function edit()
    {
        $this->updateMode = true;
    }

    public function update()
    {
        $validatedData = $this->validate();
        $this->role->update($validatedData['role']);
        $this->role->syncPermissions($validatedData['permissionCheck']);

        session()->flash('success', 'Die Berechtigungen der Rolle: '.__($this->role['name']).' wurde angepasst.');

        return redirect(route('admin.roles.index'));
    }

    public function render()
    {
        return view('livewire.admin.role.show');
    }
}
