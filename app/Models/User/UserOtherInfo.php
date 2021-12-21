<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserOtherInfo extends Model
{
    use HasFactory;

    protected $table = 'user_other_infos';

    protected $fillable = [
        'user_id',
        'award_info',
        'doc_or_link',
        'file',
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
