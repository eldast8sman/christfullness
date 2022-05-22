<?php

namespace App\Models;

use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Sluggable\HasSlug;

class Series extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = ['title', 'slug', 'description', 'filepath', 'start_date', 'end_date'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }
}
