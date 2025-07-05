<?php

namespace App\Models;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    /** @use HasFactory<\Database\Factories\ActorFactory> */
    use HasFactory;

    protected $fillable = [ 
        'actor_id',
        'movie_id',
        'role',
    ];

    protected $casts = [
        'birthdate' => 'date',
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class)
            ->withPivot('role')
            ->withTimestamps();
    }
}
