<div>
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