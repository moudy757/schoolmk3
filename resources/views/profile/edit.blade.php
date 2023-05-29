<x-app-layout>
    {{-- Page Title --}}
    <x-slot:title>
        {{ __('Profile') }}
    </x-slot:title>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    @if (session('msg'))
        <p class="bg-gray-900 text-red-700 w-fit mx-auto p-4 rounded-lg" x-data="{ show: true }" x-show="show"
            x-transition x-init="setTimeout(() => show = false, 5000)">{{ __(session('msg')) }}</p>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 lg:space-y-0 lg:flex lg:gap-10">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-900 shadow sm:rounded-lg lg:h-fit rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-900 shadow sm:rounded-lg lg:h-fit rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- <div class="p-4 sm:p-8 bg-white dark:bg-gray-900 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div> --}}
        </div>
    </div>
</x-app-layout>
