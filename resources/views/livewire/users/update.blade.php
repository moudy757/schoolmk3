<div>
    <x-secondary-button wire:click='openModalToUpdateUser'>
        <i class="fa-solid fa-pen"></i>
    </x-secondary-button>

    <x-custom-modal wire:model="openModal" maxWidth="lg">
        <x-slot:title>
            <div class="text-2xl mb-4 flex justify-center items-center">
                <span>{{ __('Edit User') }}</span>
            </div>
        </x-slot:title>
        <x-slot:content>
            <div class="p-4">
                <form wire:submit.prevent='update' class="space-y-4" id="updateUserForm-{{ $formId }}">
                    @csrf
                    {{-- Name --}}
                    <div class="space-y-4">
                        <x-input-label for="user.name" :value="__('Name')" />
                        <x-text-input wire:model.debounce.500='user.name' id="name" class="block w-full" type="text"
                            name="name" :value="old('user.name')" autofocus />
                        <x-input-error :messages="$errors->get('user.name')" class="dark:text-red-700" />
                    </div>

                    {{-- Email --}}
                    <div class="space-y-4">
                        <x-input-label for="user.email" :value="__('Email')" />
                        <x-text-input wire:model.debounce.500='user.email' id="level" class="block w-full" type="text"
                            name="level" :value="old('user.email')" autofocus />
                        <x-input-error :messages="$errors->get('user.email')" class="dark:text-red-700" />
                    </div>

                    {{-- DOB --}}
                    <div class="space-y-4">
                        <x-input-label for="user.userable.dob" :value="__('Date of Birth')" />
                        <x-text-input wire:model.debounce.500='user.userable.dob' id="level" class="block w-full"
                            type="text" name="level" :value="old('user.userable.dob')" autofocus />
                        <x-input-error :messages="$errors->get('user.userable.dob')" class="dark:text-red-700" />
                    </div>

                </form>
            </div>
        </x-slot:content>
        <x-slot:buttons>
            <x-secondary-button wire:click="$toggle('openModal')" class="dark:hover:bg-red-700 focus:ring-red-700">
                {{ __('Nevermind') }}
            </x-secondary-button>
            <x-secondary-button wire:target='update' type="submit" wire:loading.attr='disabled'
                form="updateUserForm-{{ $formId }}">
                {{ __('Update') }}
            </x-secondary-button>
        </x-slot:buttons>
    </x-custom-modal>
</div>