@error($id ?? '')
<div class="relative">
    <input {{ $attributes->merge(['value' => old($id ?? ''), 'type' => $type ?? 'text', 'wire:model.lazy' => $id ?? '', 'id' => $id ?? '', 'name' => $id ?? '', 'class' => 'shadow-sm bg-gray-50 border border-red-300 text-red-900 placeholder-red-700 text-sm rounded focus:ring-red-500 focus:border-red-500 block w-full pr-12 p-2.5 dark:bg-gray-700 dark:border-red-600 dark:placeholder-red-400 dark:text-white dark:focus:ring-red-500 dark:placeholder-red-500 dark:focus:border-red-500', 'placeholder' => $text ?? '']) }} />
    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
        {{ $icon ?? '' }}
    </div>
</div>
<span class="text-xs text-red-600 dark:text-red-500">
        {{ $message }}
    </span>
@else
    <div class="relative">
        <input {{ $attributes->merge(['value' => old($id ?? ''), 'type' => $type ?? 'text', 'wire:model.lazy' => $id ?? '', 'id' => $id ?? '', 'name' => $id ?? '', 'class' => 'shadow-sm bg-gray-50 border border-gray-300 text-gray-900 placeholder-gray-700 text-sm rounded focus:ring-gray-500 focus:border-gray-500 block w-full pr-12 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500', 'placeholder' => $text ?? '']) }} />
        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
            {{ $icon ?? '' }}
        </div>
    </div>
    @enderror
