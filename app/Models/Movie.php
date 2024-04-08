<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'imdbID',
        'year',
        'genre',
        'plot',
        'poster',
        'runtime',
    ];


    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function related(): HasMany
    {
        return $this->hasMany(Related::class, 'related_movie_id');
    }


    protected static $sorts =
    [
        'date' => 'Newest',
        'date_a' => 'Oldest',
        'alphabetical' => 'Alphabetical',
        'rating' => 'Rating descending',
        'rating_a' => 'Rating ascending'
    ];


    public static function getSorts()
    {
        return self::$sorts;
    }
}
