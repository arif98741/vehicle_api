<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedAddress extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'saved_addresses';

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'beneficiary_name',
        'district',
        'city',
        'postcode',
        'lon',
        'lat',
    ];
}
