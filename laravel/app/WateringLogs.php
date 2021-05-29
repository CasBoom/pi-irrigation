<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WateringLogs extends Model
{
    public $fillable =[
        'time', 'litre', 'success'
    ];
}
