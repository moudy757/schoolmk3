<div class="2xl:w-[75%] mx-auto">
    {{-- Page Title --}}
    <x-slot:title>
        {{ __('Users') }}
    </x-slot:title>

    {{-- Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <section>
        <div class="overflow-hidden shadow-lg rounded-lg bg-gray-700 py-8 w-full mx-auto">
            {{-- Actions --}}
            <div class="flex p-3 justify-between mx-8 mb-8">
                {{-- Search Box --}}
                <div class="w-2/6">
                    <input wire:model.debounce.300ms="search" type="text" class="rounded-lg bg-gray-800 border-none"
                        placeholder="{{ __('Search Users...') }}">
                </div>

                {{-- Order by --}}
                <div class="w-fit">
                    <select wire:model="orderBy" id="orderBy" class="rounded-lg bg-gray-800 border-none">
                        <option value="name">{{ __('Name') }}</option>
                        <option value="created_at">{{ __('Date Joined') }}</option>
                    </select>
                </div>

                {{-- Order Asc --}}
                <div class="w-fit">
                    <select wire:model="orderAsc" id="orderAsc" class="rounded-lg bg-gray-800 border-none">
                        <option value="1">{{ __('Ascending') }}</option>
                        <option value="0">{{ __('Descending') }}</option>
                    </select>
                </div>

                {{-- Per Page --}}
                <div class="w-fit">
                    <select wire:model="perPage" id="perPage" class="rounded-lg bg-gray-800 border-none">
                        <option value="5">{{ __('5') }}</option>
                        <option value="10">{{ __('10') }}</option>
                        <option value="20">{{ __('20') }}</option>
                    </select>
                </div>

                {{-- User Role --}}
                <div class="w-fit">
                    <select wire:model="role" id="role" class="rounded-lg bg-gray-800 border-none">
                        <option value="teacher">{{ __('Teachers') }}</option>
                        <option value="student">{{ __('Students') }}</option>
                        <option value="admin">{{ __('Admins') }}</option>
                    </select>
                </div>
            </div>

            {{-- Table --}}
            <div class="w-full table text-center">
                <div class="table-header-group text-base">
                    <div class="table-row">
                        <div class="table-cell py-4 px-8 text-left">
                            {{ __('Name') }}
                        </div>
                        <div class="table-cell py-4 px-8">
                            {{ __('Email') }}
                        </div>
                        <div class="table-cell py-4 px-8">
                            {{ __('Date Joined') }}
                        </div>
                        <div class="table-cell py-4 px-8">
                            {{ __('Actions') }}
                        </div>
                    </div>
                </div>
                {{-- Table Body --}}
                <div x-data="{ selected: null }" class="table-row-group">
                    @forelse ($users as $user)
                        <div class="px-8 py-6 table-row text-lg">
                            <div class="py-4 px-8 table-cell w-5/12 font-bold text-left"
                                :class="selected == {{ $user->id }} ? 'text-indigo-600' : ''">{{ $user->name }}
                            </div>
                            <div class="py-4 px-8 table-cell">{{ $user->email }}</div>
                            <div class="py-4 px-8 table-cell">{{ $user->created_at->format('m/d/y') }}</div>
                            <div class="py-4 px-8 table-cell">
                                {{-- Actions --}}
                                <div class="flex gap-2 justify-center">
                                    {{-- View Details Button --}}
                                    <x-secondary-button
                                        @click="selected !== {{ $user->id }} ? selected = {{ $user->id }} : selected = null">
                                        <i class="fa-solid fa-eye"></i></span>
                                    </x-secondary-button>

                                    {{-- Edit User Button --}}
                                    <livewire:users.update :user="$user"
                                        :wire:key="'edit-user-' . now() . $user->id" />

                                    {{-- Delete User Button --}}
                                    <livewire:users.delete :user="$user" :wire:key="'delete-user-' . $user->id" />
                                </div>
                            </div>
                        </div>
                        {{-- User Details --}}
                        <div class="relative overflow-hidden transition-all max-h-0 duration-700" style=""
                            x-ref="container{{ $user->id }}"
                            x-bind:style="selected == {{ $user->id }} ? 'max-height: ' + $refs.container{{ $user->id }}
                                .scrollHeight + 'px' : ''">
                            <div class="flex gap-2 ml-10 py-2">
                                <h1 class="mb-2">Date of Birth:</h1>
                                <p>{{ $user->userable->dob ?? 'N/A' }}</p>
                            </div>
                        </div>
                        @php
                            $record = false;
                        @endphp
                    @empty
                        @php
                            $record = true;
                        @endphp
                    @endforelse
                </div>
            </div>
            @if ($record)
                <div class="flex flex-col justify-center items-center space-y-10">
                    <p class="mt-10 text-lg">No users available.</p>
                </div>
            @endif
            {{-- Pagination --}}
            <div class="mx-6 mt-6 hidden xl:block">
                {{ $users->onEachSide(1)->links() }}
            </div>

        </div>
    </section>
</div>
