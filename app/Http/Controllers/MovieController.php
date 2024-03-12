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
    public function index()
    {
        $movies = Movie::withAvg('ratings', 'rating')->get();
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
            'rating' => 'numeric | min:0 | max:10 '
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

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $movie = Http::get($this->omdb . 'i=' . $id . '&plot=full')->collect()->all();
        $tmdbResponse = Http::get('https://api.themoviedb.org/3/search/multi?query=' . $movie['Title'] . '&include_adult=true&primary_release_year=' . $movie['Year'] . '&' . $this->tmdbKey)->collect();
        $backdrop = 'https://image.tmdb.org/t/p/w1280/' . $tmdbResponse->get('results')[0]['backdrop_path'];
        return view('movies.show', compact(['movie', 'backdrop']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
