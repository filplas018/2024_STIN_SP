<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Concerns\AsPivot;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\DB;

/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class UserSubscription extends Model
{
    use AsPivot;
    use HasFactory;


    protected $fillable = [
        'user_id',
        'subscription_id',
        'payment_id',
        'valid_from',
        'valid_until',

    ];
    protected function scopeValid(Builder $query, bool $value = true): void
    {
        $query
            ->where('valid_from', "<=", DB::raw("CURRENT_TIMESTAMP()"))
            ->where(static fn(Builder $query) => $query
                ->whereNull("valid_until")
                ->orWhere("valid_until", ">", DB::raw("CURRENT_TIMESTAMP()")
            )
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }
    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }
}
