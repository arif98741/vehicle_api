<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfessionalData extends Model
{
    use HasFactory;

    protected $table = 'user_professional_data';


    protected $fillable = [
        'user_id',
        'license_no',
        'year_of_experience',
        'speciality',
        'other_speciality',
        'personal_commitment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
