<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSlider extends Model
{
    use HasFactory;

    protected $fillable = [
        'position',
        'filename',
        'compressed',
        'caption',
        'body',
        'call_to_action',
        'link'
    ];
}
