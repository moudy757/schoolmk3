<div class="">
    <x-secondary-button wire:click="openModalToCreateArticle" class="dark:bg-gray-900">
        {{ __('Add Post') }}
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
                        <x-input-label for="name" :value="__('Post Name')" />
                        <x-text-input wire:model.debounce.500='name' id="name" class="block w-full"
                            type="text" name="name" :value="old('name')" autofocus />
                        <x-input-error :messages="$errors->get('name')" class="dark:text-red-700" />
                    </div>

                    {{-- Description --}}
                    <div class="space-y-4">
                        <x-input-label for="body" :value="__('Post Body')" />
                        {{--
                        <x-text-input wire:model.debounce.500='description' id="description" class="block w-full h-20"
                            type="" name="description" :value="old('description')" autofocus /> --}}
                        <textarea wire:model.lazy='body' id="body" name="body" rows="5"
                            class="resize-none w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
                        <x-input-error :messages="$errors->get('body')" class="dark:text-red-700" />
                    </div>

                    {{-- For whom  --}}
                    <div>
                        <div class="w-full mb-4 flex justify-between items-center">
                            <x-input-label for="forWhom" :value="__('For')" />

                            <select wire:model="forWhom" id="forWhom"
                                class="rounded-lg bg-gray-900 border-none font-medium">
                                <option selected value="">{{ __('Select for whom.') }}</option>
                                @can('news.create.admin')
                                    <option value="all">{{ __('All') }}</option>
                                    <option value="admins">{{ __('Admins') }}</option>
                                    <option value="teachers">{{ __('Teachers') }}</option>
                                @endcan
                                @can('news.create.students')
                                    <option value="students">{{ __('Students') }}</option>
                                @endcan
                            </select>
                        </div>
                        <x-input-error :messages="$errors->get('forWhom')" class="dark:text-red-700" />
                    </div>

                    @if ($forWhom == 'students')
                        {{-- For which course --}}
                        <div>
                            <div class="w-full mb-4 flex gap-4 justify-between items-center">
                                <x-input-label for="courseId" :value="__('Course')" />

                                <select wire:model="courseId" id="courseId"
                                    class="rounded-lg bg-gray-900 border-none font-medium w-3/4">
                                    <option selected value="">{{ __('Course Name') }}</option>
                                    @forelse ($courses as $course)
                                        <option value="{{ $course->id }}">{{ __($course->name) }}</option>
                                    @empty
                                        <option disabled value="">{{ __('No courses available!') }}</option>
                                    @endforelse
                                </select>
                            </div>
                            <x-input-error :messages="$errors->get('courseId')" class="dark:text-red-700" />
                        </div>
                    @endif
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
