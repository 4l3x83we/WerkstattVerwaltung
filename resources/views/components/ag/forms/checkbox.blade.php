<div class="flex items-center">
    <input type="checkbox" {{ $attributes->merge(['id' => $id, 'wire:model' => $id, 'value' => $id, 'class' => 'w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600'])  }}>
    <label for="{{ $id }}" class="{{ $classLabel }}">{{ $text }}</label>
</div>
