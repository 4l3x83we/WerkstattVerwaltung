<tr {{ $attributes->merge(['class' => "odd:bg-gray-100 border-b dark:odd:bg-gray-900 dark:odd:border-gray-700 even:bg-gray-50 dark:even:bg-gray-800 dark:even:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600"]) }}>
    {{ $slot }}
</tr>
