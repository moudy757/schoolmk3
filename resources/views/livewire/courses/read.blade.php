<div class="w-[99%] mx-auto">
    {{-- Page Title --}}
    <x-slot:title>
        {{ __('Courses') }}
    </x-slot:title>

    {{-- Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>

    {{-- Content --}}
    <section>

        @can('courses.create')
            {{-- Add Course Button --}}
            <div class="mb-4 flex justify-end">
                <livewire:courses.create />
            </div>
        @endcan

        <div class="flex gap-4 md:hidden mb-2">
            {{-- Responsive Filters --}}
            <div>
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
                                        <option value="created_at">{{ __('Date Added') }}</option>
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
                                @can('courses.own.enroll')
                                    {{-- Enrolled Courses --}}
                                    <div class="w-fit">
                                        <select wire:model="enrolled" id="enrolled"
                                            class="rounded-lg bg-gray-800 border-none">
                                            <option value="0">{{ __('All Courses') }}</option>
                                            <option value="1">{{ __('Enrolled Courses') }}</option>
                                        </select>
                                    </div>
                                @endcan
                                {{-- Per Page --}}
                                <div class="w-fit">
                                    <select wire:model="perPage" id="perPage"
                                        class="rounded-lg bg-gray-800 border-none">
                                        <option value="5">{{ __('5') }}</option>
                                        <option value="10">{{ __('10') }}</option>
                                        <option value="20">{{ __('20') }}</option>
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
                    placeholder="{{ __('Search Courses...') }}">
            </div>
        </div>
        {{-- Table with Actions --}}
        <div class="shadow-lg rounded-lg bg-gray-700 py-6 w-full mx-auto overflow-x-auto">

            {{-- Filters --}}
            <div class="hidden md:block p-2 mx-auto mb-8 w-3/4">
                {{-- Search Box --}}
                <div class="w-fit mx-auto">
                    <input wire:model.debounce.300ms="search" type="text" class="rounded-lg bg-gray-800 border-none"
                        placeholder="{{ __('Search Courses...') }}">
                </div>
                <div class="flex gap-2 justify-between mt-4">
                    {{-- Order by --}}
                    <div class="w-fit">
                        <select wire:model="orderBy" id="orderBy" class="rounded-lg bg-gray-800 border-none">
                            <option value="name">{{ __('Name') }}</option>
                            <option value="created_at">{{ __('Date Added') }}</option>
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

                    @canany(['courses.own.enroll', 'courses.enroll'])
                        {{-- Enrolled Courses --}}
                        <div class="w-fit">
                            <select wire:model="enrolled" id="enrolled" class="rounded-lg bg-gray-800 border-none">
                                <option value="0">{{ __('All Courses') }}</option>
                                <option value="1">{{ __('Enrolled Courses') }}</option>
                            </select>
                        </div>
                    @endcanany
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
                            {{ __('Level') }}
                        </div>
                        <div class="py-4">
                            {{ __('Date Added') }}
                        </div>
                        <div class="py-4 justify-self-end mr-4">
                            {{ __('Actions') }}
                        </div>
                    </div>
                </div>
                {{-- Table Body --}}
                <div x-data="{ selected: null }" class="">
                    @forelse ($courses as $course)
                        <div class="px-8 py-6 grid grid-cols-4 text-lg">
                            <div class="py-4 font-bold text-left"
                                :class="selected == {{ $course->id }} ? 'text-indigo-600' : ''">{{ $course->name }}
                            </div>
                            <div class="py-4">{{ $course->level }}</div>
                            <div class="py-4">{{ $course->created_at->format('m/d/y') }}</div>
                            <div class="py-4 justify-self-end">
                                {{-- Actions --}}
                                <div class="flex gap-2 justify-center">
                                    {{-- View Details Button --}}
                                    <x-secondary-button
                                        @click="selected !== {{ $course->id }} ? selected = {{ $course->id }} : selected = null">
                                        <i class="fa-solid fa-eye"></i></span>
                                    </x-secondary-button>

                                    @if (auth()->user()->hasRole('student'))
                                        @if (!$enrolled)
                                            @can('courses.own.enroll')
                                                <livewire:student.enroll-course :course="$course"
                                                    :wire:key="'enroll-course-'. now() . $course->id" />
                                            @endcan
                                        @elseif ($enrolled)
                                            @can('courses.own.drop')
                                                <livewire:student.drop-course :course="$course"
                                                    :wire:key="'drop-course-'. now() . $course->id" />
                                            @endcan
                                        @endif
                                    @endif

                                    @can('courses.update')
                                        {{-- Edit Course Button --}}
                                        <livewire:courses.update :course="$course"
                                            :wire:key="'edit-course-' . now() . $course->id" />
                                    @endcan
                                    @can('courses.delete')
                                        {{-- Delete Course Button --}}
                                        <livewire:courses.delete :course="$course"
                                            :wire:key="'delete-course-' . $course->id" />
                                    @endcan
                                </div>
                            </div>
                        </div>
                        {{-- Course Details --}}
                        <div class="relative overflow-hidden transition-all max-h-0 duration-700" style=""
                            x-ref="container{{ $course->id }}"
                            x-bind:style="selected == {{ $course->id }} ? 'max-height: ' + $refs.container{{ $course->id }}
                                .scrollHeight + 'px' : ''">
                            <div class="flex gap-8 px-10 py-4 items-center">
                                <div class="text-left w-1/2">
                                    <h1 class="font-bold mb-2 bg-gray-800 rounded-lg py-2 px-4 w-fit">Description:</h1>
                                    <p class="bg-gray-800 rounded-lg py-2 px-4">{{ $course->description }}</p>
                                </div>
                                @can('enrolledStudents.read')
                                    <div class="flex flex-col space-y-4">
                                        <p class="bg-gray-800 py-2 px-4 rounded-lg w-fit">No. of enrolled students:
                                            {{ $course->students->count() }}</p>
                                        <div>
                                            <livewire:teacher.enrolled-students :course="$course"
                                                :wire:key="'enrolled-students-' . $course->id" />
                                        </div>
                                    </div>
                                @endcan
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
                    <p class="mt-10 text-lg">No courses yet.</p>
                </div>
            @endif
        </div>
        {{-- Pagination --}}
        <div class="mt-6">
            {{ $courses->onEachSide(1)->links() }}
        </div>
    </section>
</div>

@push('scripts')
    <script>
        Livewire.on('updated', function(e) {
            Swal.fire({
                title: e.title,
                icon: e.icon,
                iconColor: e.iconColor,
                timer: 5000,
                toast: true,
                position: 'bottom-right',
                showConfirmButton: false,
                background: '#111827',
                color: '#f3f4f6',
            });
        });

        window.addEventListener('refresh-page', event => {
            window.location.reload(false);
        })
    </script>
@endpush
