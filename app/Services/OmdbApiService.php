<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OmdbApiService
{
    private $omdb = 'https://www.omdbapi.com/?apikey=fae14715&';

    public function search(string $key): array
    {
        return Http::get($this->omdb . 's=' . $key)->collect('Search')->all();
    }

    public function getById(string $id): array
    {
        return Http::get($this->omdb . 'i=' . $id . '&plot=full')->collect()->all();
    }
}
