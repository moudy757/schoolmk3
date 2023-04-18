<div>
    <x-secondary-button wire:click="openModalToViewStudents" class="my-4 dark:bg-gray-900">
        {{ __('Enrolled Students') }}
    </x-secondary-button>

    <x-custom-modal wire:model="openModal" maxWidth="4xl">
        <x-slot:title>
            <div class="text-2xl mb-4 flex justify-center items-center">
                <span>{{ __('Enrolled Students') }}</span>
            </div>
        </x-slot:title>
        <x-slot:content>

            <div class="p-4 space-y-6">
                @foreach ($students as $student)
                <div class="grid grid-cols-2 bg-gray-900 px-8 py-4 rounded-lg">
                    <div class="space-y-4">
                        <div class="flex gap-2">
                            <h1>Name:</h1>
                            <p>{{ $student->user->name }}</p>
                        </div>
                        <div class="flex gap-2">
                            <h1>Level:</h1>
                            <p>{{ $student->level }}</p>
                        </div>
                    </div>
                    <div x-data="{ open: false }" class="flex gap-2 items-center">
                        <h1>Grade:</h1>
                        <p @click="open = true; $wire.resetter()"
                            class="hover:text-indigo-600 cursor-pointer bg-gray-800 py-2 px-4 rounded-lg">{{
                            $student->enrolled->grade }}</p>
                        <div x-show="open" @click.outside="open = false; $wire.resetter()" class="space-y-4">
                            <x-text-input wire:model.debounce.500='grade' id="grade" class="block w-full" type="text"
                                name="grade" :value="old('grade')" autofocus
                                wire:keydown.enter="update({{ $student->id }})" />
                            <x-input-error :messages="$errors->get('grade')" class="" />
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-4 bg-gray-900 py-4 px-8 rounded-lg">
                {{ $students->onEachSide(1)->links() }}
            </div>
        </x-slot:content>
        <x-slot:buttons>
            <x-secondary-button wire:click="$toggle('openModal')" class="dark:hover:bg-red-700 focus:ring-red-700">
                {{ __('Nevermind') }}
            </x-secondary-button>
        </x-slot:buttons>
    </x-custom-modal>
</div>