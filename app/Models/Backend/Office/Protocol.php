<?php

namespace App\Models\Backend\Office;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Protocol extends Model
{
    use SoftDeletes;

    protected $fillable = ['protocol_type_nr', 'protocol_type', 'protocol_text', 'protocol_status'];
}
