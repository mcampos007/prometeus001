@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'input-primary bg-gray-300 text-gray-100 focus:bg-gray-400 border-none rounded-md shadow-md w-full',
]) !!} />


{{-- <input {
    { $disabled ? 'disabled' : '' }}
     {!! $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) !!}> --}}
