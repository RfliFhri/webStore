<div>
    <button type="button" wire:click="remove" wire:loading.attr="disabled"
        class="mt-1 text-red-500 flex items-center cursor-pointer font-semibold disabled:pointer-events-none disabled:text-red-300">
        Delete
        <div wire:loading
            class="ms-2 mt-0.5 animate-spin inline-block size-4 border-3 border-current border-t-transparent text-gray-400 rounded-full dark:text-blue-500"
            role="status" aria-label="loading">
            <span class="sr-only">Loading...</span>
        </div>
    </button>
</div>
