<?php

namespace App\Models;

use App\Events\CreatedUserEvent;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $dispatchesEvents = [
        'created' => CreatedUserEvent::class
    ];

    protected $appends = [
      'uni_request_id'
    ];

    public function setUniRequestIdAttribute(): string {
        return uniqid('ac','001');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getNameAttribute($value): string {
        return ucfirst($value);
    }

    public function setPasswordAttribute($value): string {
        return Hash::make($value);
    }
}
