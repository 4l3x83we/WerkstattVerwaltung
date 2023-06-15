@error($id ?? '')
    <label for="{{ $id ?? '' }}" class="block mb-2 text-sm font-medium text-red-700 dark:text-red-500">{{ $text ?? '' }}@if($stern ?? false) <span class="text-red-500">*</span>@endif</label>
    <input {{ $attributes->merge(['type' => $type ?? 'text', 'wire:model' => $id ?? '', 'id' => $id ?? '', 'name' => $id ?? '', 'class' => 'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-xs rounded focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-600 dark:placeholder-red-500 dark:border-red-500', 'placeholder' => $text ?? '']) }} />
    <span class="text-xs text-red-600 dark:text-red-500">
        {{ $message }}
    </span>
@else
    <label for="{{ $id ?? '' }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $text ?? '' }}@if($stern ?? false) <span class="text-red-500">*</span>@endif</label>
    <input {{ $attributes->merge(['type' => $type ?? 'text', 'wire:model' => $id ?? '', 'id' => $id ?? '', 'name' => $id ?? '', 'class' => 'shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500', 'placeholder' => $text ?? '']) }} />
@enderror
