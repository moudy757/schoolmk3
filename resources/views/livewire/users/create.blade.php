<div>
    <div class="w-1/2 bg-gray-900 rounded-lg mx-auto py-10 px-20">
        <div class="w-full mb-4 flex justify-end">
            <select wire:model="role" id="role" class="rounded-lg bg-gray-800 border-none">
                <option value="teacher">{{ __('Teacher') }}</option>
                <option value="student">{{ __('Student') }}</option>
                @can('add admins')
                    <option value="admin">{{ __('Admin') }}</option>
                @endcan
            </select>
        </div>
        <form wire:submit.prevent='create' class="space-y-4" id="addCourseForm">
            @csrf
            {{-- Name --}}
            <div class="space-y-4">
                <x-input-label for="user.name" :value="__('Name')" />
                <x-text-input wire:model.debounce.500='user.name' id="user.name" class="block w-full dark:bg-gray-700"
                    type="text" />
                <x-input-error :messages="$errors->get('user.name')" class="" />
            </div>

            {{-- Email --}}
            <div class="space-y-4">
                <x-input-label for="user.email" :value="__('Email')" />
                <x-text-input wire:model.debounce.500='user.email' id="user.email" class="block w-full dark:bg-gray-700"
                    type="text" />
                <x-input-error :messages="$errors->get('user.email')" class="" />
            </div>

            {{-- DOB --}}
            <div class="space-y-4">
                <x-input-label for="user.dob" :value="__('Date of Birth')" />
                <x-text-input wire:model.debounce.500='user.dob' id="user.dob" class="block w-full dark:bg-gray-700"
                    type="date" />
                <x-input-error :messages="$errors->get('user.dob')" class="" />
            </div>

            @if ($role == 'student')
                {{-- Level --}}
                <div class="space-y-4">
                    <x-input-label for="user.level" :value="__('Level')" />
                    <x-text-input wire:model.debounce.500='user.level' id="user.level"
                        class="block w-full dark:bg-gray-700" type="text" />
                    <x-input-error :messages="$errors->get('user.level')" class="" />
                </div>
            @endif
            <div class="flex justify-end">
                <x-secondary-button wire:target='create' type="submit" wire:loading.attr='disabled'>
                    {{ __('Add') }}
                </x-secondary-button>
            </div>
        </form>
    </div>
</div>
