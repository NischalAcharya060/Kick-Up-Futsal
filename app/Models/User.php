<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
        'profile_picture',
        'is_banned',
        'banned_until',
        'dob',
        'gender',
        'contact_number',
        'address',
        'preferred_position',
        'experience_level',
        'last_active',
        'verification_code',
        'verified',
        'register_type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'banned_until' => 'datetime',
    ];

    public function ban($duration = null)
    {
        $this->update([
            'is_banned' => true,
            'banned_until' => $duration ? now()->addMinutes($duration) : null,
        ]);
    }

    public function unban()
    {
        $this->update([
            'is_banned' => false,
            'banned_until' => null,
        ]);
    }

    public function isBanned()
    {
        return $this->is_banned && ($this->banned_until == null || now()->lt($this->banned_until));
    }

    public function bookmarkedFacilities()
    {
        return $this->belongsToMany(Facility::class, 'user_bookmarks')->withTimestamps();
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_user')->withTimestamps();
    }

}
