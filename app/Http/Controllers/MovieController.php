<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{

    private $omdb = 'https://www.omdbapi.com/?apikey=fae14715&';
    private $tmdbKey = 'api_key=a775215dabc13c77e7e60049fd00e7be';

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $movies = Movie::withAvg('ratings', 'rating');

        if ($request->has('search')) {
            $movies = $movies->where('title', 'like', '%' . $request->search . '%');
        }

        $movies = match ($request->sorting) {
            'rating' => $movies->orderBy('ratings_avg_rating', 'desc'),
            'alphabetical' => $movies->orderBy('title'),
            default => $movies
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

        $movies = $movies->paginate(6);
        return view('home', compact(['movies']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function new(Request $request)
    {
        if ($request->has('search')) {
            $movies = Http::get($this->omdb . 's=' . $request->get('search'))->collect('Search')->all();
        } else {
            $movies = Http::get($this->omdb . 's=super')->collect('Search')->all();
        }
        return view('movies.new', compact(['movies']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedRating = $request->validate([
            'rating' => 'numeric | min:0 | max:10',
            'comment' => 'nullable'
        ]);

        $movieValidated = $request->validate([
            'title' => 'present',
            'imdbID' => 'present',
            'year' => 'present',
            'genre' => 'present',
            'plot' => 'present',
            'poster' => 'present',
            'runtime' => 'present'
        ]);

        $movie = Movie::firstOrCreate($movieValidated);

        $ids['user_id'] = Auth::user()->getAuthIdentifier();
        $ids['movie_id'] = $movie->id;

        Rating::updateOrCreate($ids, $validatedRating);

        return redirect()->route('home')->with('message', 'Rating submitted successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $movie = Http::get($this->omdb . 'i=' . $id . '&plot=full')->collect()->all();
        $tmdbResponse = Http::get('https://api.themoviedb.org/3/search/multi?query=' . $movie['Title'] . '&include_adult=true&primary_release_year=' . $movie['Year'] . '&' . $this->tmdbKey)->collect();
        $backdrop = count($tmdbResponse->get('results')) === 0 ? 'https://dl.airtable.com/exploreCoverImages%2FCQDQ7kFRSJi1BYaN68YI_exploreCoverImages%252FXrQhMoZpQqeo0X5Q2t1W_4slz_rck6kq-lloyd-dirks.jpg' : 'https://image.tmdb.org/t/p/w1280/' . $tmdbResponse->get('results')[0]['backdrop_path'];
        $movieModel = Movie::query()->where('imdbID', '=', $id)->first();
        $ratings = $movieModel?->ratings;
        $ratings = isset($ratings) ? $ratings : collect([]);
        return view('movies.show', compact(['movie', 'backdrop', 'ratings']));
    }

    public function reset()
    {
        return redirect()->route('home');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $movie = Movie::query()->where('imdbID', '=', $request->imdbID)->first();
        $movie->find($movie->id)->ratings()->where('user_id', '=', $request->user_id)->first()->delete();
        return redirect()->route('home')->with('message', 'Your rating deleted successfully');
    }
}
