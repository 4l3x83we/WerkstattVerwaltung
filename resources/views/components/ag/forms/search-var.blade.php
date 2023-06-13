<label for="search" class="sr-only">Search</label>
<input type="search" wire:model.debounce.500ms="{{ $id ?? '' }}" placeholder="{{ $text ?? '' }}" id="{{ $id ?? '' }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500">

