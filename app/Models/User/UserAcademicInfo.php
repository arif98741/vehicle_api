<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class UserAcademicInfo extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'user_academic_infos';

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'institute',
        'major',
        'passing_year',
        'cgpa_grade',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
