<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'manufacturer',
        'model',
        'vin',
        'first_registration',
        'kilometers_stand',
    ];

    protected $hidden = ['is_deleted'];

}
