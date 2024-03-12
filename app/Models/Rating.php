<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
        'user_id',
        'movie_id',
    ];

    public function movie(): HasOne
    {
        return $this->hasOne(Movie::class);
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
