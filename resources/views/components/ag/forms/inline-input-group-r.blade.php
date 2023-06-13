@error($id ?? '')
<div class="sm:flex sm:items-center">
    <div class="sm:w-1/3">
        <label for="{{ $id ?? '' }}" class="block mb-2 text-sm font-medium text-red-700 dark:text-red-500">{{ $text ?? '' }}@if($stern ?? false) <span class="text-red-500">*</span> @endif</label>
    </div>
    <div class="sm:w-2/3">
        <div class="relative">
            <input {{ $attributes->merge(['value' => old($id ?? ''), 'type' => $type ?? 'text', 'wire:model.lazy' => $id ?? '', 'id' => $id ?? '', 'name' => $id ?? '', 'class' => 'shadow-sm bg-gray-50 border border-red-300 text-red-900 placeholder-red-700 text-xs rounded focus:ring-red-500 focus:border-red-500 block w-full pr-12 p-2.5 dark:bg-gray-700 dark:border-red-600 dark:placeholder-red-400 dark:text-white dark:focus:ring-red-500 dark:placeholder-red-500 dark:focus:border-red-500', 'placeholder' => $text ?? '']) }} />
            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                {{ $icon ?? '' }}
            </div>
        </div>
    </div>
</div>
<span class="text-xs text-red-600 dark:text-red-500">
        {{ $message }}
    </span>
@else
    <div class="sm:flex sm:items-center">
        <div class="sm:w-1/3">
            <label for="{{ $id ?? '' }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $text ?? '' }}@if($stern ?? false) <span class="text-red-500">*</span> @endif</label>
        </div>
        <div class="sm:w-2/3">
            <div class="relative">
                <input {{ $attributes->merge(['value' => old($id ?? ''), 'type' => $type ?? 'text', 'wire:model.lazy' => $id ?? '', 'id' => $id ?? '', 'name' => $id ?? '', 'class' => 'shadow-sm bg-gray-50 border border-gray-300 text-gray-900 placeholder-gray-700 text-xs rounded focus:ring-gray-500 focus:border-gray-500 block w-full pr-12 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500', 'placeholder' => $text ?? '']) }} />
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    {{ $icon ?? '' }}
                </div>
            </div>
        </div>
    </div>
    @enderror

