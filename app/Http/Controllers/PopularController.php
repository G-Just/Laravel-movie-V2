<?php

namespace App\Http\Controllers;

use App\Services\TmdbApiService;
use Illuminate\Http\Request;

class PopularController extends Controller
{
    public function popular(Request $request, TmdbApiService $tmdb)
    {
        $content = $tmdb->getPopular($request->type ?? 'movies');
        return view('movies.popular', compact('content'));
    }


    public function nowPlaying(Request $request, TmdbApiService $tmdb)
    {
        $content = $tmdb->getCurrent($request->type ?? 'movies');
        return view('movies.now_playing', compact('content'));
    }


    public function topRated(Request $request, TmdbApiService $tmdb)
    {
        $content = $tmdb->getTopRated($request->type ?? 'movies');
        return view('movies.top_rated', compact('content'));
    }


    public function upcoming(Request $request, TmdbApiService $tmdb)
    {
        $content = $tmdb->getUpcoming($request->type ?? 'movies');
        return view('movies.upcoming', compact('content'));
    }
}
