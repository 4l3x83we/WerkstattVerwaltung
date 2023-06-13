@error($id ?? '')
    <div class="grid justify-items-center">
        <label for="{{ $id ?? '' }}" class="text-sm font-medium text-red-700 dark:text-red-500 whitespace-nowrap">{{ $text ?? '' }}</label>
        <input {{ $attributes->merge(['type' => 'checkbox',  'id' => $id ?? '', 'class' => 'shadow-sm w-4 h-4 mt-2 text-red-700 bg-gray-100 border-red-300 rounded focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:text-red-500 dark:border-red-600', 'placeholder' => $text ?? '']) }} aria-label="{{ $text ?? '' }}" />
        <span class="ml-4 text-xs text-red-600 dark:text-red-500">
            {{ $message }}
        </span>
    </div>
@else
    <div class="grid justify-items-center">
        <label for="{{ $id ?? '' }}" class="text-sm font-medium text-gray-900 dark:text-gray-300 whitespace-nowrap">{{ $text ?? '' }}</label>
        <input {{ $attributes->merge(['type' => 'checkbox',  'id' => $id ?? '', 'class' => 'shadow-sm w-4 h-4 mt-2 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600', 'placeholder' => $text ?? '']) }} aria-label="{{ $text ?? '' }}" />
    </div>
@enderror
