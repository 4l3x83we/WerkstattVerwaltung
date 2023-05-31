<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Index.php
 * User: ${USER}
 * Date: 23.${MONTH_NAME_FULL}.2023
 * Time: 08:42
 */

namespace App\Http\Livewire\Admin\User;

use App\Exports\Backend\User\UserExport;
use App\Models\User;
use Excel;
use File;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public $sortField = 'id';

    public $sortDirection = 'asc';

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
        return redirect(route('admin.users.create'));
    }

    public function show(User $user)
    {
        return redirect(route('admin.users.show', $user->id));
    }

    public function destroy(User $user)
    {
        session()->flash('successError', $user->name.' erfolgreich gelöscht!');
        if ($user->image) {
            File::deleteDirectory(public_path('images/profil/'.replaceBlank($user->name)));
        }
        $user->delete();

        return redirect(route('admin.users.index'));
    }

    public function export()
    {
        try {
            return Excel::download(new UserExport, 'users_list.xlsx');
        } catch (Throwable $th) {
            session()->flash('error', $th->getMessage());

            return redirect()->back();
        }
    }

    public function render()
    {
        $users = User::whereLike(['name', 'email', 'roles.name'], $this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(20);

        return view('livewire.admin.user.index', ['users' => $users]);
    }
}
