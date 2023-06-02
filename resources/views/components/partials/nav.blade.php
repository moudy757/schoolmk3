<nav class="bg-gray-500 dark:bg-gray-900 py-8 px-2 text-gray-200 text-sm xl:text-lg col-span-2 lg:w-fit h-40 lg:h-full">
    <x-application-logo class="block h-10 w-auto text-indigo-600 mx-auto" />

    <ul class="min-h-full px-4 py-6 mt-4 lg:flex lg:flex-col justify-between">
        <div class="lg:space-y-4 flex items-center justify-between lg:block">
            @role('teacher')
                <li class="flex items-center">
                    <x-nav-link :href="route('teacher.index')" :active="request()->routeIs('teacher.index')" class="sm:block flex flex-col items-center">
                        <i class="fa-solid fa-house w-8 h-5"></i>
                        <span>Home</span>
                    </x-nav-link>
                </li>
                <li class="flex items-center">
                    <x-nav-link :href="route('teacher.courses')" :active="request()->routeIs('teacher.courses')" class="sm:block flex flex-col items-center">
                        <i class="fa-solid fa-chalkboard w-8 h-5"></i>
                        <span>Courses</span>
                    </x-nav-link>
                </li>
            @endrole

            @role('student')
                <li class="flex items-center">
                    <x-nav-link :href="route('student.index')" :active="request()->routeIs('student.index')" class="sm:block flex flex-col items-center">
                        <i class="fa-solid fa-house w-8 h-5"></i>
                        <span>Home</span>
                    </x-nav-link>
                </li>
                <li class="flex items-center">
                    <x-nav-link :href="route('student.courses')" :active="request()->routeIs('student.courses')" class="sm:block flex flex-col items-center">
                        <i class="fa-solid fa-chalkboard w-8 h-5"></i>
                        <span>Courses</span>
                    </x-nav-link>
                </li>
                <li class="flex items-center">
                    <x-nav-link :href="route('student.grades')" :active="request()->routeIs('student.grades')" class="sm:block flex flex-col items-center">
                        <i class="fa-solid fa-check w-8 h-5"></i></i>
                        <span>Grades</span>
                    </x-nav-link>
                </li>
            @endrole

            @hasanyrole('super-admin|admin')
                <li class="flex items-center">
                    <x-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')" class="sm:block flex flex-col items-center">
                        <i class="fa-solid fa-house w-8 h-5"></i>
                        <span>Home</span>
                    </x-nav-link>
                </li>
                <li class="flex items-center">
                    <x-nav-link :href="route('admin.add-user')" :active="request()->routeIs('admin.add-user')" class="sm:block flex flex-col items-center">
                        <i class="fa-solid fa-person-circle-plus w-8 h-5"></i>
                        <span>Add User</span>
                    </x-nav-link>
                </li>
                <li class="flex items-center">
                    <x-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users')" class="sm:block flex flex-col items-center">
                        <i class="fa-solid fa-people-group w-8 h-5"></i>
                        <span>Users</span>
                    </x-nav-link>
                </li>
                <li class="flex items-center">
                    <x-nav-link :href="route('admin.courses')" :active="request()->routeIs('admin.courses')" class="sm:block flex flex-col items-center">
                        <i class="fa-solid fa-chalkboard w-8 h-5"></i>
                        <span>Courses</span>
                    </x-nav-link>
                </li>
            @endhasanyrole
        </div>
    </ul>
</nav>
