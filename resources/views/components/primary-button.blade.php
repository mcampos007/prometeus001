{{-- <button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button> --}}

{{-- <button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center rounded-md transition ease-in-out duration-150']) }}
    style="font-size: 1.5rem; color: #f39c12; font-weight: bold; text-align: center;">
    {{ $slot }}
</button> --}}

<button
    {{ $attributes->merge([
        'class' =>
            'bg-indigo-600 text-white hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 rounded-md px-4 py-2',
    ]) }}>
    {{ $slot }}
</button>
