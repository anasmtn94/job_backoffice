<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Job Categories') }}
        </h2>
    </x-slot>

    <x-toast-notifications />

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-2xl border border-gray-100 p-6">
                <form method="POST" action="{{ route('category.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Category Name
                        </label>
                        <input 
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name') }}"
                            placeholder="e.g. Marketing"
                            class="mt-2 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm text-gray-900"
                        />
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                        <a href="{{ route('category.index') }}" 
                           class="text-sm font-medium text-gray-600 hover:text-gray-800 transition">
                            Cancel
                        </a>
                        <button 
                            type="submit"
                            class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-1 transition">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
