<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $table = 'user_addresses';

    protected $fillable = [
        'user_id',
        'district',
        'city',
        'postcode',
        'lon',
        'lat',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
