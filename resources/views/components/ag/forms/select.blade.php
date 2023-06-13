@error($id ?? '')
    <select {{ $attributes->merge(['wire:model.lazy' => $id ?? '', 'id' => $id ?? '', 'name' => $id ?? '', 'class' => 'shadow-sm bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-xs rounded focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-600 dark:placeholder-red-500 dark:border-red-500', 'placeholder' => $text ?? '']) }} >
            {{ $slot }}
    </select>
    <span class="text-xs text-red-600 dark:text-red-500">
        {{ $message }}
    </span>
@else
    <select {{ $attributes->merge(['wire:model.lazy' => $id ?? '', 'id' => $id ?? '', 'name' => $id ?? '', 'class' => 'shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500', 'placeholder' => $text ?? '']) }} >
        {{ $slot }}
    </select>
@enderror
