<div class="2xl:w-[75%] mx-auto">
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

        @role('teacher')

        {{-- Add Course Button --}}
        <livewire:courses.create />
        @endrole
        {{-- Table with Actions --}}
        <div class="overflow-hidden shadow-lg rounded-lg bg-gray-700 py-8 w-full mx-auto">

            {{-- Actions --}}
            <div class="flex p-3 justify-between mx-8 mb-8">
                {{-- Search Box --}}
                <div class="w-2/6">
                    <input wire:model.debounce.300ms="search" type="text" class="rounded-lg bg-gray-800 border-none"
                        placeholder="{{ __('Search Courses...') }}">
                </div>

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
                @role('student')
                {{-- Enrolled Courses --}}
                <div class="w-fit">
                    <select wire:model="enrolled" id="enrolled" class="rounded-lg bg-gray-800 border-none">
                        <option value="1">{{ __('Enrolled Courses') }}</option>
                        <option value="0">{{ __('All Courses') }}</option>
                    </select>
                </div>
                @endrole
            </div>
            {{-- Table --}}
            <div class="w-full table text-center">
                <div class="table-header-group text-base">
                    <div class="table-row">
                        <div class="table-cell py-4 px-8 text-left">
                            {{ __('Name') }}
                        </div>
                        <div class="table-cell py-4 px-8">
                            {{ __('Level') }}
                        </div>
                        <div class="table-cell py-4 px-8">
                            {{ __('Date Added') }}
                        </div>
                        <div class="table-cell py-4 px-8">
                            {{ __('Actions') }}
                        </div>
                    </div>
                </div>
                {{-- Table Body --}}
                <div x-data="{ selected: null }" class="table-row-group">
                    @forelse ($courses as $course)
                    <div class="px-8 py-6 table-row text-lg">
                        <div class="py-4 px-8 table-cell w-5/12 font-bold text-left"
                            :class="selected == {{ $course->id }} ? 'text-indigo-600' : ''">{{ $course->name }}
                        </div>
                        <div class="py-4 px-8 table-cell">{{ $course->level }}</div>
                        <div class="py-4 px-8 table-cell">{{ $course->created_at->format('m/d/y') }}</div>
                        <div class="py-4 px-8 table-cell">
                            {{-- Actions --}}
                            <div class="flex gap-2 justify-center">
                                {{-- View Details Button --}}
                                <x-secondary-button
                                    @click="selected !== {{ $course->id }} ? selected = {{ $course->id }} : selected = null">
                                    <i class="fa-solid fa-eye"></i></span>
                                </x-secondary-button>

                                @role('student')
                                <livewire:student.enroll-course :course="$course"
                                    :wire:key="'enroll-course-' . $course->id" />

                                @if ($enrolled)
                                <livewire:student.drop-course :course="$course"
                                    :wire:key="'drop-course-' . $course->id" />
                                @endif
                                @endrole

                                @role('teacher')
                                {{-- Edit Course Button --}}
                                <livewire:courses.update :course="$course"
                                    :wire:key="'edit-course-' . now() . $course->id" />

                                {{-- Delete Course Button --}}
                                <livewire:courses.delete :course="$course" :wire:key="'delete-course-' . $course->id" />
                                @endrole
                            </div>
                        </div>
                    </div>
                    {{-- Course Details --}}
                    <div class="relative overflow-hidden transition-all max-h-0 duration-700" style=""
                        x-ref="container{{ $course->id }}"
                        x-bind:style="selected == {{ $course->id }} ? 'max-height: ' + $refs . container{{ $course->id }} . scrollHeight + 'px' : ''">
                        <div class="ml-4 px-8 text-left">
                            <h1 class="font-bold mb-2">Description</h1>
                            <p>{{ $course->description }}</p>
                            @role('teacher')
                            <livewire:teacher.enrolled-students :course="$course"
                                :wire:key="'enrolled-students-' . $course->id" />
                            @endrole
                        </div>
                    </div>
                    @php
                    $record = false
                    @endphp
                    @empty
                    @php
                    $record = true
                    @endphp
                    @endforelse
                </div>
            </div>
            @if ($record)
            <div class="flex flex-col justify-center items-center space-y-10">
                <p class="mt-10 text-lg">No courses yet.</p>
            </div>
            @endif
            {{-- Pagination --}}
            <div class="mx-6 mt-6 hidden xl:block">
                {{ $courses->onEachSide(1)->links() }}
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
    Livewire.on('updated', function (e) {
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
</script>
@endpush