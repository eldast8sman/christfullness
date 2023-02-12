<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Event extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'event',
        'slug',
        'theme',
        'start_date',
        'end_date',
        'timing',
        'venue',
        'details',
        'filename',
        'compressed',
        'all_details'
    ];

    protected $hidden = ['all_details'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('event')
            ->saveSlugsTo('slug');
    }
}
