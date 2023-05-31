<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: RegisterCompletedController.php
 * User: ${USER}
 * Date: 29.${MONTH_NAME_FULL}.2023
 * Time: 09:41
 */

namespace App\Http\Controllers;

use App\Mail\Register\RegisterMail;
use App\Models\User;
use Illuminate\Http\Request;
use Mail;

class RegisterCompletedController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(auth()->user()->id);

        return view('auth.registerCompleted', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'strasse' => 'required',
            'plz' => 'required|max:5',
            'ort' => 'required',
            'geburtstag' => 'required',
            'telefon' => 'nullable',
            'mobil' => 'nullable',
            'image' => 'nullable',
        ]);

        $image = ['image' => $request->file('image')];
        if (! $user->image) {
            $userImage = profilImage($image, $user);
        } else {
            $userImage = $user->image;
        }
        $user->update([
            'strasse' => $request->strasse,
            'plz' => $request->plz,
            'ort' => $request->ort,
            'telefon' => $request->telefon,
            'mobil' => $request->mobil,
            'geburtstag' => $request->geburtstag,
            'image' => $userImage,
        ]);

        $user->roles()->sync(['4']);

        session()->flash('success', 'Das Profil des Benutzers: '.$user->name.' wurde hinzugefügt.');

        Mail::to('webmaster@thueringer-tuning-freunde.de')->send(new RegisterMail($user));

        return redirect(url('/'));
    }
}
