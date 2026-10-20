@props(['status'])

@php
    $colors = [
        'Pending'   => 'bg-yellow-100 text-yellow-800 border-yellow-200',
        'In Process'  => 'bg-blue-100 text-blue-800 border-blue-200',
        'Resolved'  => 'bg-green-100 text-green-800 border-green-200',
    ];

    $colorClass = $colors[$status] ?? 'bg-gray-100 text-gray-800 border-gray-200';
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center px-2.5 py-0.5 rounded-full text-ms font-medium border ' . $colorClass]) }}>
    {{ $status }}
</span>