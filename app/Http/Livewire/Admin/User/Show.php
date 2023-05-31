<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Show.php
 * User: ${USER}
 * Date: 23.${MONTH_NAME_FULL}.2023
 * Time: 08:42
 */

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use File;
use Hash;
use Illuminate\Validation\Rules;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class Show extends Component
{
    use WithFileUploads;

    public $user;

    public $password;

    public $images;

    public $roles;

    public $roleCheck = [];

    public $uploadPicture = false;

    protected $messages = [
        'user.name' => 'Name muss ausgefüllt werden.',
        'user.email' => 'E-Mail Adresse muss ausgefüllt werden.',
    ];

    public function rules()
    {
        return [
            'user.id' => 'required',
            'user.name' => 'required',
            'user.email' => 'required',
            'user.strasse' => 'required',
            'user.plz' => 'required',
            'user.ort' => 'required',
            'user.geburtstag' => 'required',
            'user.telefon' => 'nullable',
            'user.mobil' => 'nullable',
            'roleCheck.id' => 'nullable',
            'roleCheck.name' => 'nullable',
        ];
    }

    public function uploadPicture()
    {
        $this->uploadPicture = true;
    }

    public function updatedImagesImage()
    {
        $user = $this->user;
        if (File::exists($user->image)) {
            File::delete($user->image);
        }
        $user->update([
            'image' => profilImage($this->images, $this->user),
        ]);

        $this->uploadPicture = false;
        session()->flash('success', 'Das Profilbild des Benutzers: '.$user->name.' wurde geändert oder hinzugefügt.');

        return redirect(request()->header('Referer'));
    }

    public function destroyPicture()
    {
        $user = $this->user;
        File::deleteDirectory(public_path('images/profil/'.replaceBlank($user->name)));
        $this->user->update([
            'image' => null,
        ]);

        session()->flash('successError', 'Das Profilbild des Benutzers: '.$user->name.' wurde gelöscht.');

        return redirect(request()->header('Referer'));
    }

    public function changePassword()
    {
        $validatedData = $this->validate([
            'password.current_password' => 'required|string|current_password:web',
            'password.password' => ['required', 'min:8', 'confirmed', Rules\Password::defaults()],
        ], [
            'password.password' => 'Password muss ausgefüllt werden.',
            'password.current_password' => 'Das angegebene Passwort stimmt nicht mit Ihrem aktuellen Passwort überein.',
        ]);
        $this->user->forceFill([
            'password' => Hash::make($validatedData['password']['password']),
        ])->save();

        session()->flash('success', 'Das Passwort des Benutzers: '.$this->user->name.' wurde geändert.');

        return redirect(route('admin.users.index'));
    }

    public function userChange()
    {
        $validatedData = $this->validate()['user'];
        $name = $validatedData['name'];
        $email = $validatedData['email'];
        $this->user->update($validatedData);

        session()->flash('success', 'Die Benutzerdaten des Benutzers: '.$this->user->name.' wurden angepasst.');

        return redirect(route('admin.users.index'));
    }

    public function userRoles()
    {
        $this->user->syncRoles([$this->roleCheck]);

        session()->flash('success', 'Die Rolle des Benutzers: '.$this->user->name.' wurde angepasst.');

        return redirect(route('admin.users.index'));
    }

    public function mount($id)
    {
        $this->user = User::with('roles')->findOrFail($id);
        $this->roles = Role::all();
        $this->roleCheck = $this->user->roles->pluck('name')->toArray();
    }

    public function render()
    {
        return view('livewire.admin.user.show');
    }
}
