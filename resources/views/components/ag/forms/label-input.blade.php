<label for="{{ $id ?? '' }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $text ?? '' }}@if($stern ?? false) <span class="text-red-500">*</span>@endif</label>

@error($id ?? '')
<input {{ $attributes->merge(['type' => $type ?? 'text', 'wire:model' => $id ?? '', 'id' => $id ?? '', 'name' => $id ?? '', 'class' => 'shadow-sm bg-gray-50 border border-red-300 text-gray-900 sm:text-sm rounded focus:ring-gray-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-red-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-red-500', 'placeholder' => $text ?? '']) }} />
<span class="text-xs text-red-600 dark:text-red-400">
    {{ $message }}
</span>
@else
    <input {{ $attributes->merge(['type' => $type ?? 'text', 'wire:model' => $id ?? '', 'id' => $id ?? '', 'name' => $id ?? '', 'class' => 'shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500', 'placeholder' => $text ?? '']) }} />
@enderror
