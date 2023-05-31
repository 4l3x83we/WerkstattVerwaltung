@error($id ?? '')
    <input {{ $attributes->merge(['type' => 'checkbox',  'id' => $id ?? '', 'class' => 'shadow-sm w-4 h-4 text-blue-600 bg-gray-100 border-red-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-red-600', 'placeholder' => $text ?? '']) }}>
    <label for="{{ $id ?? '' }}" class="ml-2 text-sm font-medium text-red-600 dark:text-red-400">{{ $text ?? '' }}</label>
    <span class="ml-4 text-xs text-red-600 dark:text-red-400">
        {{ $message }}
    </span>
@else
    <input {{ $attributes->merge(['type' => 'checkbox',  'id' => $id ?? '', 'class' => 'shadow-sm w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600', 'placeholder' => $text ?? '']) }}>
    <label for="{{ $id ?? '' }}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $text ?? '' }}</label>
@enderror
