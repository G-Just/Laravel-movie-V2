@props(['movie', 'relatedMovies'])
@php
    $relatedMovies = $relatedMovies->map(function ($item) {
        return $item->id;
    });
@endphp
<div class="relative flex items-start w-full px-2 py-2 ml-2 min-w-52">
    <input id="{{ $movie->id }}" type="checkbox" class="hidden peer" name="related[]" value="{{ $movie->id }}"
        @if ($relatedMovies->contains($movie->id)) checked @endif>
    <label for="{{ $movie->id }}"
        class="inline-flex items-center justify-between w-full gap-2 p-2 font-medium tracking-tight border rounded-lg cursor-pointer bg-brand-light text-brand-black border-lime-300 peer-checked:border-lime-400 peer-checked:bg-lime-700 peer-checked:text-white">
        <img src="{{ $movie->poster }}" alt="Poster" class="w-12 h-20">
        <div class="flex items-center justify-center w-full truncate">
            <div class="text-sm text-brand-black">{{ $movie->title }}</div>
        </div>
    </label>
</div>
