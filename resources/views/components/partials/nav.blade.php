<nav class="bg-gray-500 dark:bg-gray-900 py-8 text-gray-200 text-xl col-span-2 2xl:col-span-1">
    <x-application-logo class="block h-10 w-auto text-indigo-600 mx-auto hover:text-black" />

    <ul class="min-h-full p-6 mt-4 flex flex-col justify-between">
        <div class="space-y-4">
            @role('teacher')
            <li class="flex gap-4 items-center">
                <x-nav-link :href="route('teacher.index')" :active="request()->routeIs('teacher.index')"
                    class="space-x-2">
                    <i class="fa-solid fa-house"></i>
                    <span>Home</span>
                </x-nav-link>
            </li>
            <li class="flex gap-4 items-center">
                <x-nav-link :href="route('teacher.courses')" :active="request()->routeIs('teacher.courses')"
                    class="space-x-2">
                    <i class="fa-solid fa-chalkboard"></i>
                    <span>Courses</span>
                </x-nav-link>
            </li>
            {{-- <li class="flex gap-4 items-center">
                <x-nav-link :href="route('teacher.enrolled-students')"
                    :active="request()->routeIs('teacher.enrolled-students')" class="space-x-2">
                    <i class="fa-solid fa-people-group"></i>
                    <span>Students</span>
                </x-nav-link>
            </li> --}}
            @endrole

            @role('student')
            <li class="flex gap-4 items-center">
                <x-nav-link :href="route('student.index')" :active="request()->routeIs('student.index')"
                    class="space-x-2">
                    <i class="fa-solid fa-house"></i>
                    <span>Home</span>
                </x-nav-link>
            </li>
            <li class="flex gap-4 items-center">
                <x-nav-link :href="route('student.courses')" :active="request()->routeIs('student.courses')"
                    class="space-x-2">
                    <i class="fa-solid fa-chalkboard"></i>
                    <span>Courses</span>
                </x-nav-link>
            </li>
            @endrole

            @role('admin')
            <li class="flex gap-4 items-center">
                <x-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')" class="space-x-2">
                    <i class="fa-solid fa-house"></i>
                    <span>Home</span>
                </x-nav-link>
            </li>
            <li class="flex gap-4 items-center">
                <x-nav-link :href="route('admin.add-user')" :active="request()->routeIs('admin.add-user')"
                    class="space-x-2">
                    <i class="fa-solid fa-person-circle-plus"></i>
                    <span>Add User</span>
                </x-nav-link>
            </li>
            <li class="flex gap-4 items-center">
                <x-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users')" class="space-x-2">
                    <i class="fa-solid fa-people-group"></i>
                    <span>Users</span>
                </x-nav-link>
            </li>
            @endrole
        </div>
    </ul>
</nav>