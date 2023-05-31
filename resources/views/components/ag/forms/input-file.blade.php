@error($id ?? '')
    <input {{ $attributes->merge(['wire:model' => $id ?? '', 'id' => $id ?? '', 'name' => $id ?? '', 'class' => 'block w-full text-xs text-gray-900 border border-red-300 rounded cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-red-600 dark:placeholder-gray-400']) }} aria-label="images">
    <span class="text-xs text-red-600 dark:text-red-400">
        {{ $message }}
    </span>
@else
    <input {{ $attributes->merge(['wire:model' => $id ?? '', 'id' => $id ?? '', 'name' => $id ?? '', 'class' => 'block w-full text-xs text-gray-900 border border-gray-300 rounded cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400']) }} aria-label="images">
@enderror
