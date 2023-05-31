<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Index.php
 * User: ${USER}
 * Date: 23.${MONTH_NAME_FULL}.2023
 * Time: 08:42
 */

namespace App\Http\Livewire\Admin\Permission;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Index extends Component
{
    public $permissions;

    public $roles;

    public $search = '';

    public function create()
    {
        return redirect(route('admin.permission.create'));
    }

    public function edit(Permission $permission)
    {
        return redirect(route('admin.permission.edit', $permission->id));
    }

    public function render()
    {
        $this->permissions = Permission::whereLike(['name'], $this->search)->get();

        return view('livewire.admin.permission.index');
    }
}
