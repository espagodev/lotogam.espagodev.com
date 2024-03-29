<?php

namespace App;

use App\Services\MarketService;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cache;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service_id',
        'grant_type',
        'access_token',
        'refresh_token',
        'token_expires_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
        'access_token',
        'refresh_token',
        'token_expires_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * Get the name for the current user
     * @return string
     */
    public function getNameAttribute()
    {
        $marketService = resolve(MarketService::class);

        $userInformation = $marketService->getUserInformation();

        return $userInformation->nombre;
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->service_id);
    }
}
