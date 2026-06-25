<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
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
     * Get the attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    /**
     * Check if user is admin
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is regular user
     *
     * @return bool
     */
    public function isUser()
    {
        return $this->role === 'user';
    }

    /**
     * Scope for active users
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for admin users
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    /**
     * Scope for regular users
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRegularUsers($query)
    {
        return $query->where('role', 'user');
    }

    /**
     * Get all crosshairs created by this user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function crossChairs()
    {
        return $this->hasMany(CrossChair::class, 'created_by');
    }

    /**
     * Get approved crosshairs created by this user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function approvedCrossChairs()
    {
        return $this->hasMany(CrossChair::class, 'created_by')->where('status', 'approved');
    }

    /**
     * Get pending crosshairs created by this user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pendingCrossChairs()
    {
        return $this->hasMany(CrossChair::class, 'created_by')->where('status', 'pending');
    }

    /**
     * Get rejected crosshairs created by this user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rejectedCrossChairs()
    {
        return $this->hasMany(CrossChair::class, 'created_by')->where('status', 'rejected');
    }

    /**
     * Get the total number of crosshairs created by this user
     *
     * @return int
     */
    public function getTotalCrossChairsAttribute()
    {
        return $this->crossChairs()->count();
    }

    /**
     * Get the total views across all user's crosshairs
     *
     * @return int
     */
    public function getTotalViewsAttribute()
    {
        return $this->crossChairs()->sum('views');
    }

    /**
     * Get the total copies across all user's crosshairs
     *
     * @return int
     */
    public function getTotalCopiesAttribute()
    {
        return $this->crossChairs()->sum('copies');
    }
    
    
    // In User.php model, add this method
        protected static function boot()
        {
            parent::boot();
            
            static::created(function ($user) {
                // Create notification when new user registers
                Notification::createNotification(
                    'new_user',
                    'New User Registered',
                    "A new user '{$user->name}' has registered on the platform.",
                    [
                        'user_id' => $user->id,
                        'link' => route('admin.users.show', $user->id), // Adjust route as needed
                    ]
                );
            });
        }
}