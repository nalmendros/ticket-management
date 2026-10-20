@props(['priority'])

@php
    $colors = [
        'Low'   => 'bg-green-100 text-green-800 border-green-200',
        'Medium'  => 'bg-orange-100 text-orange-800 border-orange-200',
        'High'  => 'bg-red-100 text-red-800 border-red-200',
    ];

    $colorClass = $colors[$priority] ?? 'bg-gray-100 text-gray-800 border-gray-200';
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center px-2.5 py-0.5 rounded-full text-ms font-medium border ' . $colorClass]) }}>
    {{ $priority }}
</span>
