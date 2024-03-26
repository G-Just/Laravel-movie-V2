<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OmdbApiService
{
    private $omdbKey = 'https://www.omdbapi.com/?apikey=';

    public function __construct()
    {
        $this->omdbKey .= config('services.apiKey.omdb') . '&';
    }

    public function search(string $key): array
    {
        return Http::get($this->omdbKey . 's=' . $key)->collect('Search')->all();
    }

    public function getById(string $id): array
    {
        return Http::get($this->omdbKey . 'i=' . $id . '&plot=full')->collect()->all();
    }
}
