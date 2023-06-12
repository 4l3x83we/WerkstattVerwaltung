@error($id ?? '')
<div class="flex items-center mr-4">
    <input {{ $attributes->merge(['type' => 'checkbox', 'id' => $id ?? '', 'value' => $id ?? '', 'class' => 'w-4 h-4 text-gray-600 bg-gray-100 border-red-300 focus:ring-gray-500 dark:focus:ring-gray-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-red-600'])  }}>
    <label for="{{ $id ?? '' }}" class="ml-2 text-sm font-medium text-red-600 dark:text-red-500">{{ $text ?? '' }}</label>
</div>
<span class="text-xs text-red-600 dark:text-red-500">
    {{ $message }}
</span>
@else
<div class="flex items-center mr-4">
    <input {{ $attributes->merge(['type' => 'checkbox', 'id' => $id ?? '', 'value' => $id ?? '', 'class' => 'w-4 h-4 text-gray-600 bg-gray-100 border-gray-300 focus:ring-gray-500 dark:focus:ring-gray-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600'])  }}>
    <label for="{{ $id ?? '' }}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $text ?? '' }}</label>
</div>
@endif
