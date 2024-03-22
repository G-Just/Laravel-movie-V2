<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Movie;
use App\Models\Rating;
use App\Services\OmdbApiService;
use App\Services\TmdbApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{

    private $tmdbKey = 'api_key=a775215dabc13c77e7e60049fd00e7be';


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
        return view('home', compact(['movies', 'sorts']));
    }


    public function popular(Request $request)
    {
        // FIXME: Fix this by using TMDB popular list api call
        if ($request->type === 'shows') {
            $content = Http::get('https://api.themoviedb.org/3/trending/tv/week?' . $this->tmdbKey)->collect('results')->toArray();
            foreach ($content as $key => $movie) {
                $content[$key]['imdbID'] = Http::get('https://api.themoviedb.org/3/tv/' . $movie['id'] . '/external_ids?' . $this->tmdbKey)->collect('imdb_id')->first();
                $content[$key]['title'] = $content[$key]['name'];
                $content[$key]['release_date'] = $content[$key]['first_air_date'];
                $content[$key]['media_type'] = 'Show';
            }
        } else {
            $content = Http::get('https://api.themoviedb.org/3/trending/movie/week?' . $this->tmdbKey)->collect('results')->toArray();
            foreach ($content as $key => $movie) {
                $content[$key]['imdbID'] = Http::get('https://api.themoviedb.org/3/movie/' . $movie['id'] . '/external_ids?' . $this->tmdbKey)->collect('imdb_id')->first();
            }
        }
        return view('movies.popular', compact('content'));
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

        return redirect()->route('home')->with('message', 'Rating submitted successfully');
    }


    public function show(string $id, OmdbApiService $omdb, TmdbApiService $tmdb)
    {
        $movie = $omdb->getById($id);
        $actors = $tmdb->getActors(explode(', ', $movie['Actors']));
        $backdrop = $tmdb->getBackdrop($movie['Type'], $movie['Title'], $movie['Year']);
        $videos = $tmdb->getVideos($movie['Type'], $movie['Title'], $movie['Year']);

        $movieModel = Movie::query()->where('imdbID', '=', $id)->first();
        $ratings = $movieModel?->ratings;
        $ratings = isset($ratings) ? $ratings : collect([]);

        return view('movies.show', compact(['movie', 'backdrop', 'ratings', 'actors', 'videos']));
    }


    public function destroy(Request $request)
    {
        $movie = Movie::query()->where('imdbID', '=', $request->imdbID)->first();
        $movie->find($movie->id)->ratings()->where('user_id', '=', $request->user_id)->first()->delete();
        return redirect()->route('home')->with('message', 'Your rating deleted successfully');
    }


    public function reset()
    {
        return redirect()->route('home');
    }
}
