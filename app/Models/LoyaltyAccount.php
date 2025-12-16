<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; // <- add this
use Illuminate\Database\Eloquent\Relations\HasMany;

class LoyaltyAccount extends Model
{
    protected $fillable = [
        'user_id',
        'balance', // needed for mass assignment
    ];

    public function pointTransactions(): HasMany
    {
        return $this->hasMany(PointTransaction::class);
    }
}

