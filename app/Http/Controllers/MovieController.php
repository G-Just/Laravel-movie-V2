<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Movie;
use App\Models\Rating;
use App\Models\Related;
use App\Services\OmdbApiService;
use App\Services\TmdbApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $movies = Movie::withAvg('ratings', 'rating');
        if ($request->has('search')) {
            $movies = $movies->where('title', 'like', '%' . $request->search . '%');
        }
        $movies = match ($request->sorting) {
            'rating' => $movies->orderBy('ratings_avg_rating', 'desc'),
            'rating_a' => $movies->orderBy('ratings_avg_rating', 'asc'),
            'alphabetical' => $movies->orderBy('title'),
            'date' => $movies->orderBy('created_at', 'desc'),
            'date_a' => $movies->orderBy('created_at', 'asc'),
            default => $movies->orderBy('created_at', 'desc')
        };
        $movies = match ($request->rated) {
            'rated' => $movies->whereHas('ratings', function ($query) {
                return $query->where('user_id', '=', Auth::user()->getAuthIdentifier());
            }),
            'not_rated' => $movies->whereDoesntHave('ratings', function ($query) {
                return $query->where('user_id', '=', Auth::user()->getAuthIdentifier());
            }),
            default => $movies
        };
        $movies = $movies->paginate(6)->appends(request()->query());
        $sorts = Movie::getSorts();
        return view('list', compact(['movies', 'sorts']));
    }


    public function new(Request $request, OmdbApiService $omdb)
    {
        if ($request->has('search')) {
            $movies = $omdb->search($request->search);
        } else {
            $movies = $omdb->search('Batman');
        }
        return view('movies.new', compact(['movies']));
    }


    public function store(StoreRequest $request)
    {
        $validatedRating = $request->safe()->only(['rating', 'comment']);
        $movieValidated = $request->safe()->except(['rating', 'comment']);
        $movie = Movie::firstOrCreate($movieValidated);
        $ids['user_id'] = Auth::user()->getAuthIdentifier();
        $ids['movie_id'] = $movie->id;
        Rating::updateOrCreate($ids, $validatedRating);
        if ($request->has('related')) {
            foreach ($request->related as $related) {
                Related::updateOrCreate(['movie_id' => $movie->id, 'related_movie_id' => $related]);
                Related::updateOrCreate(['movie_id' => $related, 'related_movie_id' => $movie->id]);
            }
        } else {
            Related::where('related_movie_id', '=', $movie->id)->delete();
            Related::where('movie_id', '=', $movie->id)->delete();
        }
        return redirect()->route('list')->with('message', 'Rating submitted successfully');
    }


    public function show(string $id, OmdbApiService $omdb, TmdbApiService $tmdb)
    {
        $movie = $omdb->getById($id);
        $actors = $tmdb->getActors(explode(', ', $movie['Actors']));
        $backdrop = $tmdb->getBackdrop($movie['Type'], $movie['Title'], $movie['Year']);
        $videos = [];
        // $tmdb->getVideos($movie['Type'], $movie['Title'], $movie['Year']);
        $movieModel = Movie::query()->where('imdbID', '=', $id)->first();
        $ratings = $movieModel?->ratings;
        $ratings = isset($ratings) ? $ratings : collect([]);
        $allMovies = collect([]);
        $relatedMovies = collect([]);
        if (isset($movieModel)) {
            $allMovies = Movie::all()->filter(function ($movie) use ($movieModel) {
                return $movie->id !== $movieModel->id;
            });
            if (count($movieModel->related) > 0) {
                $relatedMovies = $movieModel->related->map(function ($model) {
                    return $model->movie;
                });
            }
        }
        return view('movies.show', compact(['movie', 'backdrop', 'ratings', 'actors', 'videos', 'allMovies', 'movieModel', 'relatedMovies']));
    }


    public function showTMDB(string  $id, string $type, OmdbApiService $omdb, TmdbApiService $tmdb)
    {
        return $this->show($tmdb->getImdbId($id, $type), $omdb, $tmdb);
    }


    public function destroy(Request $request)
    {
        $movie = Movie::query()->where('imdbID', '=', $request->imdbID)->first();
        $movie->find($movie->id)->ratings()->where('user_id', '=', $request->user_id)->first()->delete();
        if (count($movie->ratings) === 0) {
            $movie->delete();
        };
        return redirect()->route('list')->with('message', 'Your rating deleted successfully');
    }


    public function reset()
    {
        return redirect()->route('list');
    }
}
