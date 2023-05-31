<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: BaseLayout.php
 * User: ${USER}
 * Date: 29.${MONTH_NAME_FULL}.2023
 * Time: 07:20
 */

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BaseLayout extends Component
{
    public function render(): View
    {
        return view('emails.base');
    }
}
