<?php

namespace App\Exports\Backend\User;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromQuery, ShouldAutoSize, WithHeadings
{
    public function query()
    {
        return User::select([
            'name',
            'email',
            'telefon',
            'mobil',
            'created_at',
        ]);
    }

    public function headings(): array
    {
        return [
            'Name',
            'E-Mail Adresse',
            'Telefon',
            'Mobiltelefon',
            'Angemeldet am',
        ];
    }
}
