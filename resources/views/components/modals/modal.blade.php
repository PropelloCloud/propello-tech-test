@props([
    'name' => '',
    'show' => false,
])

<div class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50" style="display: {{ $show ? 'block' : 'none' }};"
    id="modal">
    <div class="fixed inset-0 transform transition-all">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>

    <div
        class="mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg sm:mx-auto">
        {{ $slot }}
    </div>
</div>
