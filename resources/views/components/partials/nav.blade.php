<nav class="bg-gray-500 dark:bg-gray-900 py-8 text-gray-200 text-xl col-span-2 2xl:col-span-1">
    <x-application-logo class="block h-10 w-auto text-indigo-600 mx-auto" />

    <ul class="min-h-full p-6 mt-4 flex flex-col justify-between">
        <div class="space-y-4">
            @role('teacher')
                <li class="flex gap-4 items-center">
                    <x-nav-link :href="route('teacher.index')" :active="request()->routeIs('teacher.index')" class="">
                        <i class="fa-solid fa-house w-8 h-5"></i>
                        <span>Home</span>
                    </x-nav-link>
                </li>
                <li class="flex gap-4 items-center">
                    <x-nav-link :href="route('teacher.courses')" :active="request()->routeIs('teacher.courses')" class="">
                        <i class="fa-solid fa-chalkboard w-8 h-5"></i>
                        <span>Courses</span>
                    </x-nav-link>
                </li>
                {{-- <li class="flex gap-4 items-center">
                <x-nav-link :href="route('teacher.enrolled-students')"
                    :active="request()->routeIs('teacher.enrolled-students')" class="">
                    <i class="fa-solid fa-people-group"></i>
                    <span>Students</span>
                </x-nav-link>
            </li> --}}
            @endrole

            @role('student')
                <li class="flex gap-4 items-center">
                    <x-nav-link :href="route('student.index')" :active="request()->routeIs('student.index')" class="">
                        <i class="fa-solid fa-house w-8 h-5"></i>
                        <span>Home</span>
                    </x-nav-link>
                </li>
                <li class="flex gap-4 items-center">
                    <x-nav-link :href="route('student.courses')" :active="request()->routeIs('student.courses')" class="">
                        <i class="fa-solid fa-chalkboard w-8 h-5"></i>
                        <span>Courses</span>
                    </x-nav-link>
                </li>
                <li class="flex gap-4 items-center">
                    <x-nav-link :href="route('student.grades')" :active="request()->routeIs('student.grades')" class="">
                        <i class="fa-solid fa-check w-8 h-5"></i></i>
                        <span>Grades</span>
                    </x-nav-link>
                </li>
            @endrole

            @hasanyrole('super-admin|admin')
                <li class="flex gap-4 items-center">
                    <x-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')" class="">
                        <i class="fa-solid fa-house w-8 h-5"></i>
                        <span>Home</span>
                    </x-nav-link>
                </li>
                <li class="flex gap-4 items-center">
                    <x-nav-link :href="route('admin.add-user')" :active="request()->routeIs('admin.add-user')" class="">
                        <i class="fa-solid fa-person-circle-plus w-8 h-5"></i>
                        <span>Add User</span>
                    </x-nav-link>
                </li>
                <li class="flex gap-4 items-center">
                    <x-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users')" class="">
                        <i class="fa-solid fa-people-group w-8 h-5"></i>
                        <span>Users</span>
                    </x-nav-link>
                </li>
            @endhasanyrole
        </div>
    </ul>
</nav>
