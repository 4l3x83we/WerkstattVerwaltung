@error($for ?? '')
    <label {{ $attributes->merge(['for' => $for ?? '', 'class' => 'block mb-2 text-sm font-medium text-red-600 dark:text-red-400']) }}>{{ $text ?? '' }}</label>
@else
    <label {{ $attributes->merge(['for' => $for ?? '', 'class' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white']) }}>{{ $text ?? '' }}</label>
@enderror
