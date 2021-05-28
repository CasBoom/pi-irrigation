<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timeblock extends Model
{
    protected $fillable = [
        'day', 'time', 'litre'
    ];
}
