<a
    {{ $attributes->merge([
        'class' => 'block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700
        dark:text-gray-200 dark:hover:text-indigo-600 focus:outline-none focus:bg-gray-100
        dark:focus:bg-gray-800 transition duration-150 ease-in-out rounded-lg',
    ]) }}>{{ $slot }}</a>
