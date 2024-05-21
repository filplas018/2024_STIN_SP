<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @mixin Builder
 */
class User extends Authenticatable implements CanResetPassword
{
    use HasFactory;
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'email',
        'password',
        'is_active',
        'email_verified_at',

    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
        'is_active' => 'bool',
        'email_verified_at' => 'datetime',
    ];

    protected static function newFactory(): Factory
    {
        return UserFactory::new();
    }

    protected function scopeActive(Builder $query, bool $value = true): void
    {
        $query->where('is_active', $value);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(UserSubscription::class);
    }

    public function currentSubscription(): HasOne
    {
        return $this
            ->subscriptions()
            ->scopes(["valid"])
            ->one();
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }
}
