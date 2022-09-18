<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory, HasSlug;
    
    protected $fillable = ['title', 'slug', 'summary', 'minister_id', 'details', 'book_path', 'image_path', 'compressed_image'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * Fetches the Author of the Book
     */
    public function author(){
        return Minister::find($this->minister_id);
    }
}
