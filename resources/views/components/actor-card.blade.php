@props(['image', 'name'])

<div class="w-[150px] overflow-hidden flex flex-col items-center justify-center p-2 outline-1 outline-gray-500">
    <img class="w-20 h-28 rounded-xl" src={{ 'https://image.tmdb.org/t/p/w1280/' . $image }} alt="">
    <h1 class="w-[150px] overflow-hidden text-center">{{ $name }}</h1>
</div>
