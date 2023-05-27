<div>
    <x-secondary-button wire:click="openModalToDeleteUser">
        <i class="fa-solid fa-trash"></i>
    </x-secondary-button>

    <x-custom-modal wire:model="openModal" maxWidth="lg">
        <x-slot:title>
            <div class="text-2xl mb-4 flex justify-center items-center">
                <span>{{ __('Delete User') }}</span>
            </div>
        </x-slot:title>
        <x-slot:content>
            <form wire:submit.prevent='delete' class="space-y-4" id="deleteUserForm">
                @csrf

                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Are you sure you want to delete this user?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Please enter your password to confirm.') }}
                </p>

                <div class="mt-6">
                    <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                    <x-text-input wire:model.debounce.500='password' id="password" name="password" type="password"
                        class="mt-1 block w-full" placeholder="{{ __('Password') }}" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
            </form>
        </x-slot:content>
        <x-slot:buttons>
            <x-secondary-button wire:click="$toggle('openModal')"
                class="dark:hover:bg-indigo-600 focus:ring-indigo-600">
                {{ __('Nevermind') }}
            </x-secondary-button>
            <x-danger-button wire:target='delete' type="submit" wire:loading.attr='disabled' form="deleteCourseForm">
                {{ __('Delete') }}
            </x-danger-button>
        </x-slot:buttons>
    </x-custom-modal>
</div>
