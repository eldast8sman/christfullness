<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = ['title', 'slug', 'description', 'series_id', 'minister_id', 'date_preached', 'image_path', 'compressed_image', 'audio_path', 'details'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * Fetches the Series that the Message belongs to
     */
    public function series(){
        return $this->belongsTo(Series::class);
    }

    /**
     * Fetches the Minister the Message belongs to
     */
    public function minister(){
        return $this->belongsTo(Minister::class);
    }
}
