<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Speciality extends Model
{
    use HasFactory;

    protected $table = 'specialities';

    /**
     * @return BelongsToMany
     */
    public function users()
    {
        //belongsToMany($related, $table = null, $foreignPivotKey = null, $relatedPivotKey = null,
        //                                  $parentKey = null, $relatedKey = null, $relation = null)
        return $this->belongsToMany(User::class,'user_specialities');
    }
}
