<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Index.php
 * User: ${USER}
 * Date: 23.${MONTH_NAME_FULL}.2023
 * Time: 08:42
 */

namespace App\Http\Livewire\Admin\Role;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    public $roles;

    public $search = '';

    public $sortField = 'id';

    public $sortDirection = 'desc';

    public function sortBy($field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function swapSortDirection(): string
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function create()
    {
        return redirect(route('admin.roles.create'));
    }

    public function show(Role $role)
    {
        return redirect(route('admin.roles.show', $role->id));
    }

    public function render()
    {
        $this->roles = Role::whereLike(['name', 'permissions.name'], $this->search)
            ->orderBy('id', 'DESC')
            ->get();

        return view('livewire.admin.role.index', ['roles' => $this->roles]);
    }
}
