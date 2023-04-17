<div>
    {{-- Page Title --}}
    <x-slot:title>
        {{ __('News') }}
    </x-slot:title>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('News') }}
        </h2>
    </x-slot>

    <livewire:news.read />

</div>