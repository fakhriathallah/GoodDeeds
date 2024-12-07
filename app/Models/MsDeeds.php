<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MsDeeds extends Model
{
    //
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class,'owner_user_id');
    }

    public function taker(): BelongsTo
    {
        return $this->belongsTo(User::class,'taker_user_id');
    }

    protected $fillable = [
        'title',
        'description',
        'prize',
        'status',
        'owner_user_id',
        'taker_user_id',
    ];
}