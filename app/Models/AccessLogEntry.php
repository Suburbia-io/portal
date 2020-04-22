<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessLogEntry extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'payload',
    ];
}
