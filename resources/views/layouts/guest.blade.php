<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/940db39152.js" crossorigin="anonymous"></script>

</head>

<body class="font-sans text-gray-900 antialiased dark">
    <div class="h-screen py-10 bg-gray-100 dark:bg-gray-900">
        <div class="mb-10">
            <a href="/">
                <x-application-logo class="h-20 w-auto block text-indigo-600 mx-auto hover:text-black" />
            </a>
        </div>

        <div @class(['sm:grid sm:grid-cols-2 flex flex-col gap-10 items-center justify-items-center h-[90%]'=>
            isset($welcome),
            'flex justify-center h-[90%] items-center' => !isset($welcome),
            ])>

            @if (isset($welcome))
            <div>
                {{ $welcome }}
            </div>
            @endif

            <div
                class="w-[95%] h-fit sm:w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>