<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Meta;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        // Standardtitel
        Meta::title('Dies ist eine Anwendung der Thüringer Tuning Freunde für die Termin- und Lagerverwaltung.');

        // Standardroboter
        Meta::set('robots', 'index, follow');

        // Standardbild
        Meta::set('image', asset('images/Logo_neu.png'));
    }
}
