<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CrossChair extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'created_by',
        'name',
        'slug',
        'description',
        'crosshair_code',
        'image',
        'order',
        'is_active',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'views',
        'copies',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
        'views' => 'integer',
        'copies' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Boot method to auto-generate slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($crosschair) {
            if (empty($crosschair->slug)) {
                $crosschair->slug = Str::slug($crosschair->name);
            }
            
            // Set created_by to current user if not set
            if (empty($crosschair->created_by) && auth()->check()) {
                $crosschair->created_by = auth()->id();
            }
            
            // Set default status if not set
            if (empty($crosschair->status)) {
                $crosschair->status = 'pending';
            }
        });
        static::created(function ($crosschair) {
            // Only create notification if submitted by regular user (not admin)
            $user = User::find($crosschair->created_by);
            
            if ($user && $user->role === 'user') {
                Notification::createNotification(
                    'crosshair_submission',
                    'New Crosshair Submission',
                    "User '{$user->name}' submitted a new crosshair: {$crosschair->name}",
                    [
                        'user_id' => $crosschair->created_by,
                        'crosshair_id' => $crosschair->id,
                        'link' => route('admin.CrossChair.edit', $crosschair->id),
                        'extra_data' => [
                            'crosshair_name' => $crosschair->name,
                            'status' => $crosschair->status,
                        ]
                    ]
                );
            }
        });

        static::updating(function ($crosschair) {
            if (empty($crosschair->slug)) {
                $crosschair->slug = Str::slug($crosschair->name);
            }
        });
    }

    /**
     * Relationship with Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relationship with User (creator)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Parse crosshair code and generate metadata
     *
     * @return array
     */
    public function parseCrosshairCode()
    {
        // Parse the Valorant crosshair code
        // Format: 0;P;C;1;h;0;f;0;0l;5;0o;0;0a;1;0f;0;1b;0
        
        $parts = explode(';', $this->crosshair_code);
        $parsed = [];
        
        foreach ($parts as $part) {
            if (preg_match('/^([a-zA-Z0-9]+)$/', $part, $matches)) {
                $parsed[] = $matches[1];
            }
        }
        
        return $parsed;
    }

    /**
     * Get color name from code
     *
     * @return string
     */
    public function getColorName()
    {
        $code = $this->crosshair_code;
        
        if (strpos($code, 'C;1;') !== false) return 'White';
        if (strpos($code, 'C;2;') !== false) return 'Red';
        if (strpos($code, 'C;5;') !== false) return 'Green';
        if (strpos($code, 'C;7;') !== false) return 'Cyan';
        if (strpos($code, 'C;8;') !== false) return 'Yellow';
        
        return 'Custom';
    }

    /**
     * Increment view count
     *
     * @return bool
     */
    public function incrementViews()
    {
        return $this->increment('views');
    }

    /**
     * Increment copy count
     *
     * @return bool
     */
    public function incrementCopies()
    {
        return $this->increment('copies');
    }

    /**
     * Scope for active crosshairs
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered crosshairs
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('created_at', 'desc');
    }

    /**
     * Scope for approved crosshairs
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope for pending crosshairs
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for rejected crosshairs
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Scope for popular crosshairs (sorted by views)
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePopular($query, $limit = 10)
    {
        return $query->orderBy('views', 'desc')->limit($limit);
    }

    /**
     * Scope for trending crosshairs (sorted by copies)
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTrending($query, $limit = 10)
    {
        return $query->orderBy('copies', 'desc')->limit($limit);
    }

    /**
     * Scope for crosshairs by specific creator
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByCreator($query, $userId)
    {
        return $query->where('created_by', $userId);
    }

    /**
     * Check if crosshair is approved
     *
     * @return bool
     */
    public function isApproved()
    {
        return $this->status === 'approved';
    }

    /**
     * Check if crosshair is pending
     *
     * @return bool
     */
    public function isPending()
    {
        return $this->status === 'pending';
    }

    /**
     * Check if crosshair is rejected
     *
     * @return bool
     */
    public function isRejected()
    {
        return $this->status === 'rejected';
    }

    /**
     * Approve the crosshair
     *
     * @return bool
     */
    public function approve()
    {
        return $this->update(['status' => 'approved']);
    }

    /**
     * Reject the crosshair
     *
     * @return bool
     */
    public function reject()
    {
        return $this->update(['status' => 'rejected']);
    }

    /**
     * Set status to pending
     *
     * @return bool
     */
    public function setPending()
    {
        return $this->update(['status' => 'pending']);
    }

    /**
     * Check if current user is the creator
     *
     * @return bool
     */
    public function isCreatedByCurrentUser()
    {
        return auth()->check() && $this->created_by === auth()->id();
    }

    /**
     * Get status badge color
     *
     * @return string
     */
    public function getStatusBadgeColor()
    {
        return match($this->status) {
            'approved' => 'success',
            'pending' => 'warning',
            'rejected' => 'danger',
            default => 'secondary',
        };
    }

    /**
     * Get status display text
     *
     * @return string
     */
    public function getStatusText()
    {
        return ucfirst($this->status);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

}