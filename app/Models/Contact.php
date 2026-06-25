<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'subject',
        'crosshair_code',
        'message',
        'status',
        'ip_address',
        'user_agent',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the formatted subject.
     */
    public function getFormattedSubjectAttribute(): string
    {
        return ucwords(str_replace('_', ' ', $this->subject));
    }

    /**
     * Scope a query to only include pending contacts.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include read contacts.
     */
    public function scopeRead($query)
    {
        return $query->where('status', 'read');
    }

    /**
     * Mark contact as read.
     */
    public function markAsRead(): bool
    {
        return $this->update(['status' => 'read']);
    }

    /**
     * Mark contact as replied.
     */
    public function markAsReplied(): bool
    {
        return $this->update(['status' => 'replied']);
    }

    /**
     * Archive the contact.
     */
    public function archive(): bool
    {
        return $this->update(['status' => 'archived']);
    }
    // In Contact.php model, add this method
    protected static function boot()
    {
        parent::boot();
        
        static::created(function ($contact) {
            // Create notification when contact form is submitted
            Notification::createNotification(
                'contact_form',
                'New Contact Form Submission',
                "New contact message from {$contact->name} - Subject: {$contact->formatted_subject}",
                [
                    'contact_id' => $contact->id,
                    'link' => route('admin.contacts.show', $contact->id), // Adjust route as needed
                    'extra_data' => [
                        'email' => $contact->email,
                        'subject' => $contact->subject,
                    ]
                ]
            );
        });
    }
}