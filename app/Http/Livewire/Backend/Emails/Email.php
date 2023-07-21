<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Email.php
 * User: ${USER}
 * Date: 21.${MONTH_NAME_FULL}.2023
 * Time: 08:38
 */

namespace App\Http\Livewire\Backend\Emails;

use App\Models\Backend\Emails\Emails;
use Livewire\Component;

class Email extends Component
{
    public function render()
    {
        $emails = Emails::get();

        return view('livewire.backend.emails.email', [
            'emails' => $emails,
        ]);
    }
}
