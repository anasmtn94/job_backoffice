@if (session('success'))
    <div 
        x-data="{ show: true }" 
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        x-init="setTimeout(() => show = false, 4000)"
        class="fixed top-5 right-5 bg-green-100 border border-green-200 text-green-800 px-4 py-3 rounded-xl shadow-md flex items-center gap-2 z-50"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 13l4 4L19 7" />
        </svg>
        <span class="text-sm font-medium">{{ session('success') }}</span>
    </div>
@endif

@if (session('fail'))
    <div 
        x-data="{ show: true }" 
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        x-init="setTimeout(() => show = false, 5000)"
        class="fixed top-5 right-5 bg-red-100 border border-red-200 text-red-800 px-4 py-3 rounded-xl shadow-md flex items-center gap-2 z-50"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18L18 6M6 6l12 12" />
        </svg>
        <span class="text-sm font-medium">{{ session('fail') }}</span>
    </div>
@endif
