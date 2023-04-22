<div>
    @if (request()->routeIs('admin.index'))
    {{-- Page Title --}}
    <x-slot:title>
        {{ __('News') }}
    </x-slot:title>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('News') }}
        </h2>
    </x-slot>

    <livewire:news.read />
    @elseif (request()->routeIs('admin.users'))
    {{-- Page Title --}}
    <x-slot:title>
        {{ __('Users') }}
    </x-slot:title>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <livewire:users.read />
    @elseif (request()->routeIs('admin.add-user'))
    {{-- Page Title --}}
    <x-slot:title>
        {{ __('Add User') }}
    </x-slot:title>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add User') }}
        </h2>
    </x-slot>

    <livewire:users.create />
    @endif
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

    Livewire.on('created', function (e) {
        Swal.fire({
            title: e.title,
            icon: e.icon,
            iconColor: e.iconColor,
            toast: false,
            position: 'center',
            showConfirmButton: true,
            background: '#111827',
            color: '#f3f4f6',
        });
    });
</script>
@endpush