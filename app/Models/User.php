<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'tier',
        'avatar',
        'provider',
        'provider_id',
        'provider_token',
        'paystack_customer_code',
        'paystack_subscription_code',
        'paystack_email_token',
        'subscription_status',
        'subscription_ends_at',
        'current_period_end',
        'subscription_plan',
        'selected_tools',
        // 2FA
        'two_factor_method',
        'two_factor_secret',
        'two_factor_confirmed',
        'two_factor_phone',
        'two_factor_code',
        'two_factor_expires_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_code',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at'     => 'datetime',
            'password'              => 'hashed',
            'subscription_ends_at'  => 'datetime',
            'current_period_end'    => 'datetime',
            'selected_tools'        => 'array',
            'two_factor_confirmed'  => 'boolean',
            'two_factor_expires_at' => 'datetime',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role === 'admin';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function hasTwoFactorEnabled(): bool
    {
        return $this->two_factor_confirmed && !empty($this->two_factor_method);
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }

    public function toolUsages()
    {
        return $this->hasMany(ToolUsage::class);
    }

    public function hasToolAccess(string $slug): bool
    {
        if ($this->tier === 'agency') return true;
        $selected = $this->selected_tools ?? [];
        return in_array($slug, $selected);
    }

    public function toolLimit(): int
    {
        return config('plans.' . $this->tier . '.tools', 0);
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
