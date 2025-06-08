<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tip extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'category',
        'locale',
        'action_steps',
        'is_active',
    ];

    protected $casts = [
        'action_steps' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Scope to get tips by locale
     */
    public function scopeByLocale($query, $locale = 'en')
    {
        return $query->where('locale', $locale);
    }

    /**
     * Scope to get active tips
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get tips by category
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}
