<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSpeciality extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'speciality_id',
    ];

}
