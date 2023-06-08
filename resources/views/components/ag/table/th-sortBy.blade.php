<span {{ $attributes->merge(['class' => 'inline-flex items-center cursor-pointer']) }}>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="ml-1 w-3 h-3 {{ $field === $id && $direction === 'asc' ? 'text-blue-500 hover:text-blue-600' : '' }}">
      <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18" />
    </svg>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 {{ $field === $id && $direction === 'desc' ? 'text-blue-500 hover:text-blue-600' : '' }}">
      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3" />
    </svg>
</span>
