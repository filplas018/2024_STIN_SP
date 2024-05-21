<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */
class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        "price",
        "is_active",
    ];

    protected $casts = [
        "price" => "float",
        "is_active" => "boolean",
    ];

    public function userSubscription(): HasMany
    {
        return $this->hasMany(UserSubscription::class);
    }
}
