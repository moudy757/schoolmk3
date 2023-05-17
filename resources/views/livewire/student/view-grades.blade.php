<div>
    {{-- Page Title --}}
    <x-slot:title>
        {{ __('Grades') }}
    </x-slot:title>

    {{-- Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Grades') }}
        </h2>
    </x-slot>

    {{-- Content --}}
    <section>
        <div class="bg-gray-700 w-[90%] xl:w-1/2 mx-auto p-6 rounded-lg space-y-8">
            @forelse ($courses as $course)
                <div class="flex justify-between items-center gap-10">
                    <div>
                        {{ $course->name }}
                    </div>
                    <div>
                        {{ $course->pivot->grade }}
                    </div>
                </div>
            @empty
                <div class="flex flex-col justify-center items-center space-y-4">
                    <h1 class="">No Enrolled courses yet.</h1>
                    <a href="{{ route('student.courses') }}"
                        class="bg-gray-900 py-2 px-4 rounded-lg hover:bg-indigo-600">Enroll
                        Now</a>
                </div>
            @endforelse
        </div>
    </section>
</div>
