@error($id ?? '')
    <input {{ $attributes->merge(['value' => old($id ?? ''), 'wire:model.lazy' => $id ?? '', 'id' => $id ?? '', 'name' => $id ?? '', 'class' => 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-xs rounded focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full dark:text-red-600 dark:placeholder-red-500 dark:border-red-500']) }} aria-label="images">
    <span class="text-xs text-red-600 dark:text-red-500">
        {{ $message }}
    </span>
@else
    <input {{ $attributes->merge(['value' => old($id ?? ''), 'wire:model.lazy' => $id ?? '', 'id' => $id ?? '', 'name' => $id ?? '', 'class' => 'block w-full text-xs text-gray-900 border border-gray-300 rounded cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400']) }} aria-label="images">
@enderror
