<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TmdbApiService
{
    private $tmdbKey = 'api_key=a775215dabc13c77e7e60049fd00e7be';
    private $defaultBackdrop = 'https://dl.airtable.com/exploreCoverImages%2FCQDQ7kFRSJi1BYaN68YI_exploreCoverImages%252FXrQhMoZpQqeo0X5Q2t1W_4slz_rck6kq-lloyd-dirks.jpg';

    public function getSearch(string $type, string|int $query, array|null $options = null): array
    {
        $type === 'series' ? $type = 'tv' : $type;

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
            . $this->tmdbKey)->collect('results')->toArray()[0];
    }

    public function getActors(array $actors): array
    {
        $actorsArray = [];

        foreach ($actors as $actor) {
            $actorsArray[$actor] = $this->getSearch('person', $actor);
        }

        return $actorsArray;
    }

    public function getBackdrop(string $type, string $title, string $year): string
    {
        $tmdbResponse = $this->getSearch($type, $title, ['primary_release_year' => $year]);

        $backdrop = count($tmdbResponse) === 0 || $tmdbResponse['backdrop_path'] === null
            ? $this->defaultBackdrop
            : 'https://image.tmdb.org/t/p/w1280/' . $tmdbResponse['backdrop_path'];

        return $backdrop;
    }

    public function getVideos(string $type, string $title, string $year): array
    {
        $tmdbResponse = $this->getSearch($type, $title, ['primary_release_year' => $year]);

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
}
