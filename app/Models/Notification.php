<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'message',
        'user_id',
        'crosshair_id',
        'contact_id',
        'link',
        'is_read',
        'read_at',
        'data',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
        'data' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function crosshair()
    {
        return $this->belongsTo(CrossChair::class, 'crosshair_id');
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    // Scopes
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeRecent($query, $limit = 10)
    {
        return $query->orderBy('created_at', 'desc')->limit($limit);
    }

    // Methods
    public function markAsRead()
    {
        return $this->update([
            'is_read' => true,
            'read_at' => now(),
        ]);
    }

    public function markAsUnread()
    {
        return $this->update([
            'is_read' => false,
            'read_at' => null,
        ]);
    }

    // Get icon based on notification type
    public function getIconAttribute()
    {
        return match($this->type) {
            'contact_form' => 'fas fa-envelope',
            'crosshair_submission' => 'fas fa-crosshairs',
            'new_user' => 'fas fa-user-plus',
            default => 'fas fa-bell',
        };
    }

    // Get color based on notification type
    public function getColorAttribute()
    {
        return match($this->type) {
            'contact_form' => 'info',
            'crosshair_submission' => 'warning',
            'new_user' => 'success',
            default => 'primary',
        };
    }

    // Static method to create notifications
    public static function createNotification($type, $title, $message, $data = [])
    {
        return self::create([
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'user_id' => $data['user_id'] ?? null,
            'crosshair_id' => $data['crosshair_id'] ?? null,
            'contact_id' => $data['contact_id'] ?? null,
            'link' => $data['link'] ?? null,
            'data' => $data['extra_data'] ?? null,
        ]);
    }
}