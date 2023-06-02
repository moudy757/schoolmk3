<div class="w-[99%] mx-auto">
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

        <div class="flex gap-4 md:hidden mb-2">
            {{-- Responsive Filters --}}
            <div class="">
                <x-dropdown align="left" width="" contentClasses="bg-gray-900">
                    <x-slot name="trigger">
                        <button class="text-gray-100 bg-gray-900 px-4 py-2 rounded-lg">
                            <div><i class="fa-solid fa-filter"></i> Filters</div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="p-4">
                            <div class="flex flex-col gap-2 justify-between mt-4">
                                {{-- Order by --}}
                                <div class="w-fit">
                                    <select wire:model="orderBy" id="orderBy"
                                        class="rounded-lg bg-gray-800 border-none">
                                        <option value="name">{{ __('Name') }}</option>
                                        <option value="created_at">{{ __('Date Joined') }}</option>
                                    </select>
                                </div>

                                {{-- Order Asc --}}
                                <div class="w-fit">
                                    <select wire:model="orderAsc" id="orderAsc"
                                        class="rounded-lg bg-gray-800 border-none">
                                        <option value="1">{{ __('Ascending') }}</option>
                                        <option value="0">{{ __('Descending') }}</option>
                                    </select>
                                </div>

                                {{-- Per Page --}}
                                <div class="w-fit">
                                    <select wire:model="perPage" id="perPage"
                                        class="rounded-lg bg-gray-800 border-none">
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
                                        @can('admins.create')
                                            <option value="admin">{{ __('Admins') }}</option>
                                        @endcan
                                    </select>
                                </div>
                            </div>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>
            {{-- Search Box --}}
            <div class="w-fit mx-auto">
                <input wire:model.debounce.300ms="search" type="text" class="rounded-lg bg-gray-900 border-none"
                    placeholder="{{ __('Search Users...') }}">
            </div>
        </div>

        <div class="overflow-x-auto shadow-lg rounded-lg bg-gray-700 py-8 w-full mx-auto">

            {{-- Filters --}}
            <div class="hidden md:block p-2 mx-auto mb-8 w-3/4">
                {{-- Search Box --}}
                <div class="w-fit mx-auto">
                    <input wire:model.debounce.300ms="search" type="text" class="rounded-lg bg-gray-800 border-none"
                        placeholder="{{ __('Search Users...') }}">
                </div>
                <div class="flex gap-2 justify-between mt-4">
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
                            @can('admins.create')
                                <option value="admin">{{ __('Admins') }}</option>
                            @endcan
                        </select>
                    </div>
                </div>

            </div>

            {{-- Table --}}
            <div class="text-center 2xl:px-20 px-4 w-[50rem] lg:w-full">
                <div class="text-base">
                    <div class="grid grid-cols-4 px-8">
                        <div class="py-4 text-left">
                            {{ __('Name') }}
                        </div>
                        <div class="py-4">
                            {{ __('Email') }}
                        </div>
                        <div class="py-4">
                            {{ __('Date Joined') }}
                        </div>
                        <div class="py-4 justify-self-end mr-4">
                            {{ __('Actions') }}
                        </div>
                    </div>
                </div>
                {{-- Table Body --}}
                <div x-data="{ selected: null }" class="">
                    @forelse ($users as $user)
                        <div class="px-8 py-6 grid grid-cols-4 text-lg">
                            <div class="py-4 font-bold text-left"
                                :class="selected == {{ $user->id }} ? 'text-indigo-600' : ''">{{ $user->name }}
                            </div>
                            <div class="py-4">{{ $user->email }}</div>
                            <div class="py-4">{{ $user->created_at->format('m/d/y') }}</div>
                            <div class="py-4 justify-self-end">
                                {{-- Actions --}}
                                <div class="flex gap-2 justify-center">
                                    {{-- View Details Button --}}
                                    <x-secondary-button
                                        @click="selected !== {{ $user->id }} ? selected = {{ $user->id }} : selected = null">
                                        <i class="fa-solid fa-eye"></i></span>
                                    </x-secondary-button>

                                    @can('users.update`')
                                        {{-- Edit User Button --}}
                                        <livewire:users.update :user="$user"
                                            :wire:key="'edit-user-' . now() . $user->id" />
                                    @endcan
                                    @can('users.delete')
                                        {{-- Delete User Button --}}
                                        <livewire:users.delete :user="$user" :wire:key="'delete-user-' . $user->id" />
                                    @endcan
                                </div>
                            </div>
                        </div>
                        {{-- User Details --}}
                        <div class="relative overflow-hidden transition-all max-h-0 duration-700" style=""
                            x-ref="container{{ $user->id }}"
                            x-bind:style="selected == {{ $user->id }} ? 'max-height: ' + $refs.container{{ $user->id }}
                                .scrollHeight + 'px' : ''">
                            <div class="px-10 py-4">
                                <div>
                                    @can('users.read')
                                        @if ($role == 'teacher')
                                            <div class="space-y-6 w-2/3 mx-auto">
                                                <div class="grid grid-cols-3 justify-between bg-gray-800 py-2 rounded-lg">
                                                    <div class="px-4">Course name</div>
                                                    <div class="px-4">No. of enrolled students
                                                    </div>
                                                    <div class="px-4">Actions</div>
                                                </div>
                                                @forelse ($user->userable->courses as $course)
                                                    <div
                                                        class="grid grid-cols-3 items-center justify-between bg-gray-800 py-4 px-4 rounded-lg">
                                                        <div>
                                                            {{ $course->name }}
                                                        </div>
                                                        <div>
                                                            {{ $course->students->count() }}
                                                        </div>
                                                        <div>
                                                            @can('enrolledStudents.read')
                                                                <livewire:teacher.enrolled-students :course="$course"
                                                                    :wire:key="'enrolled-students-' . $course->id" />
                                                            @endcan
                                                        </div>
                                                    </div>
                                                @empty
                                                    <p class="text-center bg-gray-800 py-2 px-4 rounded-lg">
                                                        No courses yet!
                                                    </p>
                                                @endforelse
                                            </div>
                                        @elseif($role == 'student')
                                            <div class="flex gap-4 justify-center items-center">
                                                <div class="w-1/3 space-y-4">
                                                    <p class="bg-gray-800 px-4 py-2 rounded-lg">Date of Birth:
                                                        {{ $user->userable->dob }}</p>
                                                    <div class="bg-gray-800 px-4 py-2 rounded-lg">
                                                        No. of courses:
                                                        {{ $user->userable->courses->count() }}
                                                    </div>
                                                </div>

                                                <div class="w-1/3 space-y-4">
                                                    @forelse ($user->userable->courses as $course)
                                                        <div>
                                                            <div
                                                                class="bg-gray-800 px-4 py-2 rounded-lg flex justify-between">
                                                                <p>{{ $course->name }}</p>
                                                                @can('courses.drop')
                                                                    <livewire:student.drop-course :course="$course"
                                                                        :student="$user->userable"
                                                                        :wire:key="'drop-course-' . now() . $user->userable->id" />
                                                                @endcan
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <p class="bg-gray-800 px-4 py-2 rounded-lg">Not enrolled in any
                                                            courses yet.</p>
                                                    @endforelse
                                                </div>
                                            </div>
                                        @endif
                                    @endcan
                                </div>
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
