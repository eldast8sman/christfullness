<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Devotional extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'devotional_date', 
        'topic', 
        'bible_text', 
        'memory_verse_text', 
        'memory_verse', 
        'devotional', 
        'further_reading', 
        'prayers'
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['devotional_date', 'topic'])
            ->saveSlugsTo('slug');
    } 
}
