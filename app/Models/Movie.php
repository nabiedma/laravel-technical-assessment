<?php

namespace App\Models;

use App\Models\Actor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    /** @use HasFactory<\Database\Factories\MovieFactory> */
    use HasFactory;

    protected $fillable = [ 
        'title',
        'genre',
        'director',
        'description',
        'release_date',
        'duration',
        'rating',
    ];

    protected $casts = [
        'release_date' => 'date',
        'rating' => 'decimal:1',
    ];

    public function actors()
    {
        return $this->belongsToMany(Actor::class)
            ->withPivot('role')
            ->withTimestamps();
    }
}
