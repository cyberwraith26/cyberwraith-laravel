<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseStudy extends Model
{
    protected $fillable = [
        'title', 'slug', 'client_name', 'category', 'emoji',
        'accent_color', 'tagline', 'overview', 'challenge',
        'solution', 'results', 'tech_stack', 'duration_weeks', 'published',
    ];

    protected $casts = [
        'published'  => 'boolean',
        'results'    => 'array',
        'tech_stack' => 'array',
    ];

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }
}
