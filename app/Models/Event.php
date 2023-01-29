<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'event',
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
}
