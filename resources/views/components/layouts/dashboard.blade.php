@php use ArtisanBR\StarterPack\Facades\StarterPackTheme; @endphp
<x-starter-pack::layouts.base :title="$title ?? null">

    @php($user = auth()->user())

    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
    @endpush
    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css"/>
    @endpush

    {{-- NAVBAR mobile only --}}
    <x-nav sticky class="lg:hidden">
        <x-slot:brand>
            <x-starter-pack::dashboard-brand class="p-5 pt-3" icon-class="pt-3"/>


        </x-slot:brand>
        <x-slot:actions>
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-icon name="o-bars-3" class="cursor-pointer"/>
            </label>
        </x-slot:actions>
    </x-nav>

    {{-- MAIN --}}
    <x-main full-width collapse-text="Esconder">
        {{-- SIDEBAR --}}
        <x-slot:sidebar drawer="main-drawer" collapsible
                        class="bg-stone-950 text-white dark:bg-stone-950 dark:text-white">

            {{-- BRAND --}}
            <a href="/" wire:navigate>
                <!-- Hidden when collapsed -->
                <div {{ $attributes->class(["hidden-when-collapsed"]) }}>
                    <div class="flex justify-center mt-3 gap-2">
            <span
                class="font-bold text-3xl mr-3 bg-gradient-to-r from-purple-500 to-pink-300 bg-clip-text text-transparent ">
                               <img src="{{ Vite::image('logos/logo-light.webp') }}" alt="Artisan Logo" class="w-48">
                            </span>
                    </div>
                </div>

                <!-- Display when collapsed -->
                <div class="display-when-collapsed hidden mx-5 mt-5 lg:mb-6 h-[28px]">
                    <img src="{{ Vite::image('icon.webp') }}" alt="Artisan Icon" class="w-20">
                </div>
            </a>

            {{-- MENU --}}
            <x-menu activate-by-route>

                {{-- User --}}
                @if($user)
                    <x-menu-separator/>

                    <x-list-item :item="$user" value="name" sub-value="email" no-separator no-hover
                                 class="!-my-2 rounded bg-stone-700/75 !mt-3 !mx-0">
                        <x-slot:actions>
                            <div class="flex">
                                <div class="tooltip" data-tip="Alternar Tema">
                                    <x-theme-toggle class="btn btn-circle btn-ghost btn-xs me-2"/>
                                </div>

                                <x-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip="Sair"
                                          no-wire-navigate link="/logout"/>
                            </div>

                        </x-slot:actions>
                    </x-list-item>

                    {{--<x-menu-separator/>--}}
                @endif

            </x-menu>
            <x-starter-pack::menu-builder name="sidebar" active-bg-color="bg-stone-700" auto-active/>
            {{--{!! MenuBuilder::render('sidebar') !!}--}}
        </x-slot:sidebar>

        {{-- The `$slot` goes here --}}
        <x-slot:content class="!px-0 !pt-0">
            @if($header ?? false)
                {{ $header }}
            @else
                <x-starter-pack::layouts.dashboard.header
                    class="navbar bg-base-100 md:sticky top-0 z-50 px-5 shadow-md">
                    <x-slot:start>
                        @if($headerStart ?? false)
                            {{ $headerStart ?? '' }}
                        @else
                            <x-starter-pack::menu-builder name="header" horizontal/>
                        @endif
                    </x-slot:start>
                    <x-slot:middle>
                        @if($headerMiddle ?? false)
                            {{ $headerMiddle ?? '' }}
                        @endif
                    </x-slot:middle>
                    <x-slot:end>
                        @if($headerEnd ?? false)
                            {{ $headerEnd ?? '' }}
                        @elseif($user)
                            <div class="flex tooltip tooltip-bottom" data-tip="Alternar Tema">
                                <x-theme-toggle class="btn btn-circle btn-sm"/>
                            </div>
                            <div class="flex h-[42px]">
                                <x-dropdown>
                                    <x-slot:trigger class="tooltip tooltip-left" data-tip="Menu do Usuário">
                                        <x-avatar :image="$user->avatar_url"
                                                  class="!w-10 !rounded-lg cursor-pointer"/>
                                    </x-slot:trigger>

                                    {{-- User --}}
                                    <x-menu-item @click.stop=""
                                                 class="!-my-2 rounded bg-stone-200 dark:bg-stone-800 !mt-3 !mx-0">

                                        <div class="flex-1 overflow-hidden whitespace-nowrap text-ellipsis truncate">
                                            <div class="py-3">
                                                <div class="font-semibold truncate">
                                                    {{ $user->name }}
                                                </div>

                                                <div class="text-gray-400 text-sm truncate">
                                                    {{ $user->email }}
                                                </div>
                                            </div>
                                        </div>
                                    </x-menu-item>
                                    <x-menu-separator/>

                                    <x-menu-item title="Editar Perfil"
                                                 :link="route('dashboard.users.create')"/>
                                    <x-menu-item title="Sair" no-wire-navigate :link="route('auth.logout')"
                                                 icon="o-power"
                                                 tooltip="Desconectar Sessão"/>
                                </x-dropdown>
                            </div>
                        @endif
                    </x-slot:end>
                </x-starter-pack::layouts.dashboard.header>
            @endif
            <div class="px-10 pt-8">
                {{ $slot }}
            </div>
        </x-slot:content>
    </x-main>
</x-starter-pack::layouts.base>
