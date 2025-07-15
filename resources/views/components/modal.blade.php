@props(['model', 'maxWidth' => 'max-w-md'])

<div x-data="{ show: @entangle($attributes->wire('model')) }" x-show="show" x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 flex items-center justify-center" style="display: none;">

    <!-- Overlay -->
    <div x-show="show" x-transition.opacity
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/30 backdrop-blur-sm" @click="show = false">
    </div>

    <!-- Modal -->
    <div x-show="show" x-transition
        class="bg-white rounded-xl shadow-2xl z-50 w-full {{ $maxWidth }} max-h-[90vh] overflow-y-auto mx-4 relative"
        @click.away="show = false">
        {{ $slot }}
    </div>
</div>
