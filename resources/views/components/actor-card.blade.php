@props(['image', 'name'])

<div class="w-[150px] overflow-hidden flex flex-col items-center justify-center p-2 outline-1 outline-gray-500">
    <div class="flex items-center object-cover w-20 overflow-hidden h-28">
        <img class="rounded-xl"
            src={{ $image ? 'https://image.tmdb.org/t/p/w1280/' . $image : 'https://i.pinimg.com/474x/57/70/f0/5770f01a32c3c53e90ecda61483ccb08.jpg' }}
            alt="">
    </div>
    <h1 class="w-[150px] overflow-hidden text-center">{{ $name }}</h1>
</div>
