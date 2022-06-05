<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Minister extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = ['name', 'slug', 'about', 'position', 'phone', 'email', 'status', 'filepath', 'compressed'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function books(){
        return $this->hasMany(Book::class);
    }
}
