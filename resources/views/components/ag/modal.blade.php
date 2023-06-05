<div class="fixed z-40 inset-0 overflow-y-auto ease-out duration-400">

    <div class="fixed inset-0 transform transition-opacity" wire:click="closeModal()">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>

    <div class="relative top-20 mx-auto w-3/4 shadow-lg rounded bg-white dark:bg-gray-700">
        {{ $slot }}
    </div>
</div>
