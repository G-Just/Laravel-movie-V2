<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class TmdbApiService
{
    private $tmdbKey = 'api_key=';
    private $defaultBackdrop = 'https://dl.airtable.com/exploreCoverImages%2FCQDQ7kFRSJi1BYaN68YI_exploreCoverImages%252FXrQhMoZpQqeo0X5Q2t1W_4slz_rck6kq-lloyd-dirks.jpg';

    public function __construct()
    {
        $this->tmdbKey .= config('services.apiKey.tmdb');
    }

    public function getSearch(string $type, string|int $query, array|null $options = null): array
    {
        $type = match ($type) {
            'series' => 'tv',
            'movie' => 'movie',
            'person' => 'person',
            default => 'multi'
        };

        $params = '';
        if ($options) {
            foreach ($options as $param => $value) {
                $params = $params . '&' . $param . '=' . $value;
            }
        }

        return Http::get('https://api.themoviedb.org/3/search/' . $type . '?query='
            . $query
            . '&include_adult=true&language=en-US'
            . $params
            . '&'
            . $this->tmdbKey)->collect('results')->toArray();
    }

    public function getActors(array $actors): array
    {
        $actorsArray = [];

        foreach ($actors as $actor) {
            $actorsArray[$actor] = $this->getSearch('person', $actor)[0];
        }

        return $actorsArray;
    }

    public function getBackdrop(string $type, string $title, string $year): string
    {
        $tmdbResponse = $this->getSearch($type, $title, ['primary_release_year' => $year])[0];

        $backdrop = count($tmdbResponse) === 0 || $tmdbResponse['backdrop_path'] === null
            ? $this->defaultBackdrop
            : 'https://image.tmdb.org/t/p/w1280/' . $tmdbResponse['backdrop_path'];

        return $backdrop;
    }

    public function getVideos(string $type, string $title, string $year): array
    {
        $tmdbResponse = $this->getSearch($type, $title, ['primary_release_year' => $year])[0];

        $type === 'series' ? $type = 'tv' : $type;

        if (in_array('tv', $tmdbResponse)) {
            $tmdbVideosResponse = Http::get('https://api.themoviedb.org/3/' . $type . '/' . $tmdbResponse['id'] . '/videos'
                . '?'
                . $this->tmdbKey)->collect('results');
        } else {
            $tmdbVideosResponse = Http::get('https://api.themoviedb.org/3/' . $type . '/' . $tmdbResponse['id'] . '/videos'
                . '?'
                . $this->tmdbKey)->collect('results');
        }

        $videos = [];
        foreach ($tmdbVideosResponse as $video) {
            if ($video['site'] === 'YouTube') {
                $videos[$video['name']] = $video['key'];
            }
        };

        return $videos;
    }

    public function getPopular(string $type)
    {
        if ($type === 'shows') {
            if (Cache::has('popularShows')) {
                return Cache::get('popularShows');
            } else {;
                $content = Http::get('https://api.themoviedb.org/3/trending/tv/week?' . $this->tmdbKey)->collect('results')->toArray();
                $this->unifyShows($content);
                Cache::put('popularShows', $content, now()->addDay());
            }
        } else {
            if (Cache::has('popularMovies')) {
                return Cache::get('popularMovies');
            } else {
                $content = Http::get('https://api.themoviedb.org/3/movie/popular?' . $this->tmdbKey)->collect('results')->toArray();
                $this->unifyMovies($content);
                Cache::put('popularMovies', $content, now()->addDay());
            }
        }
        return $content;
    }

    public function getCurrent(string $type)
    {
        if ($type === 'shows') {
            if (Cache::has('currentShows')) {
                return Cache::get('currentShows');
            } else {;
                $content = Http::get('https://api.themoviedb.org/3/tv/airing_today?' . $this->tmdbKey)->collect('results')->toArray();
                $this->unifyShows($content);
                Cache::put('currentShows', $content, now()->addDay());
            }
        } else {
            if (Cache::has('currentMovies')) {
                return Cache::get('currentMovies');
            } else {
                $content = Http::get('https://api.themoviedb.org/3/movie/now_playing?' . $this->tmdbKey)->collect('results')->toArray();
                $this->unifyMovies($content);
                Cache::put('currentMovies', $content, now()->addDay());
            }
        }
        return $content;
    }

    public function getTopRated(string $type)
    {
        if ($type === 'shows') {
            if (Cache::has('topShows')) {
                return Cache::get('topShows');
            } else {;
                $content = Http::get('https://api.themoviedb.org/3/tv/top_rated?' . $this->tmdbKey)->collect('results')->toArray();
                $this->unifyShows($content);
                Cache::put('topShows', $content, now()->addDay());
            }
        } else {
            if (Cache::has('topMovies')) {
                return Cache::get('topMovies');
            } else {
                $content = Http::get('https://api.themoviedb.org/3/movie/top_rated?' . $this->tmdbKey)->collect('results')->toArray();
                $this->unifyMovies($content);
                Cache::put('topMovies', $content, now()->addDay());
            }
        }
        return $content;
    }

    public function getUpcoming(string $type)
    {
        if ($type === 'shows') {
            if (Cache::has('upcomingShows')) {
                return Cache::get('upcomingShows');
            } else {;
                $content = Http::get('https://api.themoviedb.org/3/tv/on_the_air?' . $this->tmdbKey)->collect('results')->toArray();
                $this->unifyShows($content);
                Cache::put('upcomingShows', $content, now()->addDay());
            }
        } else {
            if (Cache::has('upcomingMovies')) {
                return Cache::get('upcomingMovies');
            } else {
                $content = Http::get('https://api.themoviedb.org/3/movie/upcoming?' . $this->tmdbKey)->collect('results')->toArray();
                $this->unifyMovies($content);
                Cache::put('upcomingMovies', $content, now()->addDay());
            }
        }
        return $content;
    }

    private function unifyMovies($content)
    {
        foreach ($content as $key => $movie) {
            $content[$key]['type'] = 'Movie';
        };

        return $content;
    }

    private function unifyShows($content)
    {
        foreach ($content as $key => $show) {
            $content[$key]['title'] = $content[$key]['name'];
            $content[$key]['release_date'] = $content[$key]['first_air_date'];
            $content[$key]['type'] = 'Show';
        }

        return $content;
    }

    public function getImdbId(string $id, string $type)
    {
        return Http::get('https://api.themoviedb.org/3/' . $type . '/' . $id . '/external_ids?' . $this->tmdbKey)->collect('imdb_id')->first();
    }
}
