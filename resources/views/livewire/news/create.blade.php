<div class="w-1/3 mt-8">
    <x-secondary-button wire:click="openModalToCreateArticle" class="float-right mr-6 mb-4">
        {{ __('Add Article') }}
    </x-secondary-button>

    <x-custom-modal wire:model="openModal" maxWidth="lg">
        <x-slot:title>
            <div class="text-2xl mb-4 flex justify-center items-center">
                <span>{{ __('Add Article') }}</span>
            </div>
        </x-slot:title>
        <x-slot:content>
            <div class="p-4">
                <form wire:submit.prevent='create' class="space-y-4" id="addArticleForm">
                    @csrf
                    {{-- Name --}}
                    <div class="space-y-4">
                        <x-input-label for="name" :value="__('Article Name')" />
                        <x-text-input wire:model.debounce.500='name' id="name" class="block w-full" type="text"
                            name="name" :value="old('name')" autofocus />
                        <x-input-error :messages="$errors->get('name')" class="dark:text-red-700" />
                    </div>

                    {{-- Description --}}
                    <div class="space-y-4">
                        <x-input-label for="body" :value="__('Article Body')" />
                        {{--
                        <x-text-input wire:model.debounce.500='description' id="description" class="block w-full h-20"
                            type="" name="description" :value="old('description')" autofocus /> --}}
                        <textarea wire:model.lazy='body' id="body" name="body" rows="5"
                            class="resize-none w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
                        <x-input-error :messages="$errors->get('body')" class="dark:text-red-700" />
                    </div>
                </form>
            </div>
        </x-slot:content>
        <x-slot:buttons>
            <x-secondary-button wire:click="$toggle('openModal')" class="dark:hover:bg-red-700 focus:ring-red-700">
                {{ __('Nevermind') }}
            </x-secondary-button>
            <x-secondary-button wire:target='create' type="submit" wire:loading.attr='disabled' form="addArticleForm">
                {{ __('Add') }}
            </x-secondary-button>
        </x-slot:buttons>
    </x-custom-modal>
</div>