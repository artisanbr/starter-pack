<x-starter-pack::layouts.base>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div>
            <a href="/" wire:navigate>
                <x-starter-pack::logo class="w-64 text-gray-500"/>
            </a>
        </div>

        <!-- Page Content -->
        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            {{-- MAIN --}}
            <x-main full-width>
                {{-- The `$slot` goes here --}}
                <x-slot:content>
                    {{ $slot }}
                </x-slot:content>
            </x-main>
        </div>
        <div class="flex mt-5 justify-center">
            <x-theme-toggle class="btn btn-circle" tooltip="Alternar Tema"/>
        </div>


    </div>

</x-starter-pack::layouts.base>
