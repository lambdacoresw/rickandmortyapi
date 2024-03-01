<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Characters extends Model
{
    use HasFactory;

    protected $table = 'characters';
    public $fillable = [
        'name', 
        'status', 
        'species', 
        'type',
        'gender',
        'image', 
        'origin_name', 
        'origin_url', 
        'location_name', 
        'location_url',
        'episodes'
    ];

    protected $casts = [
        'episodes' => 'array'
    ];
}
