<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Create.php
 * User: ${USER}
 * Date: 23.${MONTH_NAME_FULL}.2023
 * Time: 08:42
 */

namespace App\Http\Livewire\Admin\User;

use App\Mail\User\CreateUserBackendMail;
use App\Models\User;
use Livewire\Component;
use Mail;

class Create extends Component
{
    public $user;

    public $email;

    public function create()
    {
        $validatedData = $this->validate([
            'user.name' => 'required|max:255',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'user.strasse' => 'required|max:255',
            'user.plz' => 'required|max:255',
            'user.ort' => 'required|max:255',
            'user.telefon' => 'nullable|numeric',
            'user.mobil' => 'nullable|numeric',
            'user.geburtstag' => 'nullable|date',
        ], [
            'user.name' => 'Name muss ausgefüllt werden.',
            'email' => 'E-Mail Adresse muss ausgefüllt werden.',
            'user.strasse' => 'Straße muss ausgefüllt werden.',
            'user.plz' => 'PLZ muss ausgefüllt werden.',
            'user.ort' => 'Ort muss ausgefüllt werden.',
            'user.telefon' => 'Telefon muss eine Zahl sein.',
            'user.mobil' => 'Mobil muss eine Zahl sein.',
        ]);
        $validatedData['user']['email'] = $this->email;
        $validatedData['user']['password'] = password_generate(12);
        $userEntry = User::create($validatedData['user']);

        $user = $validatedData['user'];
        $userID = $userEntry->id;
        $userEntry->roles()->sync(['3']);

        session()->flash('success', 'Der Benutzer '.$validatedData['user']['name'].' wurde angelegt.');
        Mail::to($validatedData['user']['email'])->send(new CreateUserBackendMail($user, $userID));

        return redirect(route('admin.users.index'));
    }

    public function render()
    {
        return view('livewire.admin.user.create');
    }
}
