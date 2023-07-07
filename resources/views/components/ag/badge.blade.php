@props(['color' => 'green', 'text' => ''])

@php
    $color = [
        'blue' => 'bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300',
        'gray' => 'bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300',
        'red' => 'bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300',
        'green' => 'bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300',
        'yellow' => 'bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300',
        'indigo' => 'bg-indigo-100 text-indigo-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-indigo-900 dark:text-indigo-300',
        'purple' => 'bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300',
        'pink' => 'bg-pink-100 text-pink-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-pink-900 dark:text-pink-300',
        'orange' => 'bg-orange-100 text-orange-500 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-orange-200 dark:text-orange-600',
        'blue-sm' => 'bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300',
        'gray-sm' => 'bg-gray-100 text-gray-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300',
        'red-sm' => 'bg-red-100 text-red-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300',
        'green-sm' => 'bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300',
        'yellow-sm' => 'bg-yellow-100 text-yellow-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300',
        'indigo-sm' => 'bg-indigo-100 text-indigo-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-indigo-900 dark:text-indigo-300',
        'purple-sm' => 'bg-purple-100 text-purple-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300',
        'pink-sm' => 'bg-pink-100 text-pink-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-pink-900 dark:text-pink-300',
        'orange-sm' => 'bg-orange-100 text-orange-500 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-orange-200 dark:text-orange-600',
        'blue-border' => 'bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-400 border border-blue-400',
        'gray-border' => 'bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400 border border-gray-500',
        'red-border' => 'bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-400 border border-red-400',
        'green-border' => 'bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-400 border border-green-400',
        'yellow-border' => 'bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300 border border-yellow-300',
        'indigo-border' => 'bg-indigo-100 text-indigo-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-indigo-900 dark:text-indigo-400 border border-indigo-400',
        'purple-border' => 'bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-400 border border-purple-400',
        'pink-border' => 'bg-pink-100 text-pink-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-pink-900 dark:text-pink-400 border border-pink-400',
        'orange-border' => 'bg-orange-100 text-orange-500 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-orange-200 dark:text-orange-600 border border-orange-600',
        'white-border' => 'bg-white text-black text-xs font-medium px-2.5 py-0.5 rounded dark:bg-white dark:text-black border border-black',
    ][$color ?? 'green'];
@endphp

<span {!! $attributes->merge(['class' => $color]) !!}>
    {{ $slot }}
</span>
