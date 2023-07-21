<?php

namespace App\Models\Backend\Emails;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Emails extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'email_art',
        'email_empfaenger',
        'email_betreff',
        'email_send_date',
        'invoice_id',
    ];

    protected $casts = [
        'email_send_date' => 'date:Y-m-d',
    ];
}
