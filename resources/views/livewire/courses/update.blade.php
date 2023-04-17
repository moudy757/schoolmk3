<div>
    <x-secondary-button wire:click='openModalToUpdateCourse'><i class="fa-solid fa-pen"></i></x-secondary-button>

    <x-custom-modal wire:model="openModal" maxWidth="lg">
        <x-slot:title>
            <div class="text-2xl mb-4 flex justify-center items-center">
                <span>{{ __('Edit Course') }}</span>
            </div>
        </x-slot:title>
        <x-slot:content>
            <div class="p-4">
                <form wire:submit.prevent='update' class="space-y-4" id="updateCourseForm-{{ $formId }}">
                    @csrf
                    {{-- Name --}}
                    <div class="space-y-4">
                        <x-input-label for="course.name" :value="__('Name')" />
                        <x-text-input wire:model.debounce.500='course.name' id="name" class="block w-full" type="text"
                            name="name" :value="old('course.name')" autofocus />
                        <x-input-error :messages="$errors->get('course.name')" class="dark:text-red-700" />
                    </div>

                    {{-- Description --}}
                    <div class="space-y-4">
                        <x-input-label for="course.description" :value="__('Description')" />
                        {{--
                        <x-text-input wire:model.debounce.500='description' id="description" class="block w-full h-20"
                            type="" name="description" :value="old('description')" autofocus /> --}}
                        <textarea wire:model.lazy='course.description' id="description" name="description" rows="5"
                            class="resize-none w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
                        <x-input-error :messages="$errors->get('course.description')" class="dark:text-red-700" />
                    </div>

                    {{-- Level --}}
                    <div class="space-y-4">
                        <x-input-label for="course.level" :value="__('Level')" />
                        <x-text-input wire:model.debounce.500='course.level' id="level" class="block w-full" type="text"
                            name="level" :value="old('course.level')" autofocus />
                        <x-input-error :messages="$errors->get('course.level')" class="dark:text-red-700" />
                    </div>

                </form>
            </div>
        </x-slot:content>
        <x-slot:buttons>
            <x-secondary-button wire:click="$toggle('openModal')" class="dark:hover:bg-red-700 focus:ring-red-700">
                {{ __('Nevermind') }}
            </x-secondary-button>
            <x-secondary-button wire:target='update' type="submit" wire:loading.attr='disabled'
                form="updateCourseForm-{{ $formId }}">
                {{ __('Update') }}
            </x-secondary-button>
        </x-slot:buttons>
    </x-custom-modal>
</div>