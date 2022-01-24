<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'herstellerin',
        'modell',
        'fin',
        'erste_registrierung',
        'kilometerstand',
        'erstellt_am',
        'aktualisiert_am',
    ];

    protected $hidden = ['ist_gelöscht', 'created_at', 'updated_at'];

}
