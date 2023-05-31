@error($for ?? '')
    <label {{ $attributes->merge(['for' => $for ?? '', 'class' => 'block mb-2 text-sm font-medium text-red-700 dark:text-red-500']) }}>{{ $text ?? '' }}@if($stern ?? false) <span class="text-white">*</span>@endif</label>
@else
    <label {{ $attributes->merge(['for' => $for ?? '', 'class' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white']) }}>{{ $text ?? '' }}@if($stern ?? false) <span class="text-red-500">*</span>@endif</label>
@enderror
