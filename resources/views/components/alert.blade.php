@props(['type' => 'info'])

@php
    $bgColor = match ($type) {
        'danger' => 'bg-red-100 text-red-800',
        'success' => 'bg-green-100 text-green-800',
        'warning' => 'bg-yellow-100 text-yellow-800',
        default => 'bg-blue-100 text-blue-800',
    };
@endphp

<div {{ $attributes->merge(['class' => "p-4 rounded-lg $bgColor"]) }}>
    {{ $slot }}
</div>
