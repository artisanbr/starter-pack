<a href="/" wire:navigate>
    <!-- Hidden when collapsed -->
    <div {{ $attributes->class(["hidden-when-collapsed"]) }}>
        <div class="flex items-center gap-2">
            <span
                class="font-bold text-3xl mr-3 bg-gradient-to-r from-purple-500 to-pink-300 bg-clip-text text-transparent ">
                                <x-starter-pack::logo class="w-48"/>
                            </span>
        </div>
    </div>

    <!-- Display when collapsed -->
    <div class="display-when-collapsed hidden mx-5 mt-5 lg:mb-6 h-[28px]">
        <img src="{{ Vite::image('icon.webp') }}" alt="Artisan Icon" class="w-20">
    </div>
</a>
