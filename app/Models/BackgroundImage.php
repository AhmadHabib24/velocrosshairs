<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackgroundImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'assigned_categories',
        'created_by',
    ];

    protected $casts = [
        'assigned_categories' => 'array',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function categories()
    {
        return Category::whereIn('id', $this->assigned_categories ?? [])->get();
    }
    
    // Get background images for a specific category
    public static function getForCategory($categoryId)
    {
        return self::where('assigned_categories', 'like', '%"' . $categoryId . '"%')
            ->orWhereJsonContains('assigned_categories', $categoryId)
            ->get();
    }
}