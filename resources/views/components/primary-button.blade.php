<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
