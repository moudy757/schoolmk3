<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <x-partials.head :title="$title ?? config('app.name')" />
</head>

<body class="font-sans antialiased dark">
    {{-- <div class="bg-red-900 p-2 text-white text-center text-xl">
        <h1>DEV Site</h1>
    </div> --}}

    {{-- @hasanyrole('teacher|admin')
        <div class="flex flex-col space-y-10 items-center bg-neutral-900 justify-center lg:hidden h-screen">
            <h1 class="text-base sm:text-2xl text-white text-center">Please use a larger screen device for better
                experience.</h1> --}}
    {{-- Logout Button --}}
    {{-- <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"
                    class="bg-neutral-700 px-4 py-2 rounded-lg cursor-pointer hover:bg-neutral-800 hover:text-indigo-600">
                    {{ __('Log Out') }}
                </a>
            </form>
        </div>
    @endhasanyrole --}}
    <div class="min-h-screen bg-gray-300 dark:bg-gray-800 lg:grid lg:grid-cols-12 2xl:grid-cols-10">

        {{-- @include('layouts.navigation') --}}
        <x-partials.nav />

        <div class="col-span-10 2xl:col-span-9">

            <!-- Page Heading -->
            {{-- @if (isset($header)) --}}
            <header class="bg-white dark:bg-gray-900 drop-shadow-md px-10 flex justify-between">
                <div class="max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>

                {{-- Settings Dropdown --}}
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48" contentClasses="bg-gray-700">
                        <x-slot name="trigger">
                            <button class="flex text-gray-100">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-2">
                                    <i class="fa-solid fa-angle-down h-3 w-auto "></i>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            {{-- Logout Button --}}
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
            </header>
            {{-- @endif --}}

            <!-- Page Content -->
            <main class="text-gray-100 py-14 w-full mx-auto">
                {{ $slot }}
            </main>
        </div>
    </div>

    <x-partials.footer />

    <livewire:scripts />
    @stack('scripts')
</body>

</html>
