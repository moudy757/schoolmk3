<div>
    <x-secondary-button wire:click="openModalToCreateCourse" class="float-right mr-6 mb-4 dark:bg-gray-900">
        {{ __('Add Course') }}
    </x-secondary-button>

    <x-custom-modal wire:model="openModal" maxWidth="lg">
        <x-slot:title>
            <div class="text-2xl mb-4 flex justify-center items-center">
                <span>{{ __('Add Course') }}</span>
            </div>
        </x-slot:title>
        <x-slot:content>
            <div class="p-4">
                <form wire:submit.prevent='create' class="space-y-4" id="addCourseForm">
                    @csrf
                    {{-- Name --}}
                    <div class="space-y-4">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input wire:model.debounce.500='name' id="name" class="block w-full" type="text"
                            name="name" :value="old('name')" autofocus />
                        <x-input-error :messages="$errors->get('name')" class="" />
                    </div>

                    {{-- Description --}}
                    <div class="space-y-4">
                        <x-input-label for="description" :value="__('Description')" />
                        {{--
                        <x-text-input wire:model.debounce.500='description' id="description" class="block w-full h-20"
                            type="" name="description" :value="old('description')" autofocus /> --}}
                        <textarea wire:model.lazy='description' id="description" name="description" rows="5"
                            class="resize-none w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
                        <x-input-error :messages="$errors->get('description')" class="" />
                    </div>

                    {{-- Level --}}
                    <div class="space-y-4">
                        <x-input-label for="level" :value="__('Level')" />
                        <x-text-input wire:model.debounce.500='level' id="level" class="block w-full" type="text"
                            name="level" :value="old('level')" autofocus />
                        <x-input-error :messages="$errors->get('level')" class="" />
                    </div>

                </form>
            </div>
        </x-slot:content>
        <x-slot:buttons>
            <x-secondary-button wire:click="$toggle('openModal')" class="dark:hover:bg-red-700 focus:ring-red-700">
                {{ __('Nevermind') }}
            </x-secondary-button>
            <x-secondary-button wire:target='create' type="submit" wire:loading.attr='disabled' form="addCourseForm">
                {{ __('Add') }}
            </x-secondary-button>
        </x-slot:buttons>
    </x-custom-modal>
</div>