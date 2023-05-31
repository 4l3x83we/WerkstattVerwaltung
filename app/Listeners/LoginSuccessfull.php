<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: LoginListener.php
 * User: ${USER}
 * Date: 29.${MONTH_NAME_FULL}.2023
 * Time: 16:53
 */

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Session;

class LoginSuccessfull
{
    public function __construct()
    {
    }

    public function handle(Login $event): void
    {
        Session::flash('success', 'Hallo '.$event->user->name.', willkommen zurück!');
    }
}
