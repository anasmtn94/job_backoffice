<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create Company') }}
            </h2>
            <a href="{{ route('company.index') }}"
               class="inline-flex items-center px-3 py-1.5 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg shadow-sm hover:bg-gray-200">
                ⬅️ Back
            </a>
        </div>
    </x-slot>

    <x-toast-notifications />

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('company.store') }}" class="space-y-8">
                @csrf

                {{-- Company Card --}}
                <div class="bg-white shadow-sm rounded-2xl border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Company Details</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        {{-- Company Name --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="company-name">Name</label>
                            <input id="company-name" type="text" name="company[name]"
                                   value="{{ old('company.name') }}"
                                   class="mt-2 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                   required>
                            @error('company.name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Industry --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="company-industry">Industry</label>
                            <select id="company-industry" name="company[industry]"
                                    class="mt-2 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                    required>
                                <option value="" disabled {{ old('company.industry') ? '' : 'selected' }}>Select…</option>
                                @foreach($industries as $ind)
                                    <option value="{{ $ind }}" {{ old('company.industry')===$ind ? 'selected':'' }}>
                                        {{ $ind }}
                                    </option>
                                @endforeach
                            </select>
                            @error('company.industry')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Website --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="company-website">Website</label>
                            <input id="company-website" type="url" name="company[website]"
                                   value="{{ old('company.website') }}"
                                   class="mt-2 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                   placeholder="https://example.com">
                            @error('company.website')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Address --}}
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700" for="company-address">Address</label>
                            <input id="company-address" type="text" name="company[address]"
                                   value="{{ old('company.address') }}"
                                   class="mt-2 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            @error('company.address')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Owner Card --}}
                <div class="bg-white shadow-sm rounded-2xl border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Owner Account</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        {{-- Owner Name --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="owner-name">Full Name</label>
                            <input id="owner-name" type="text" name="owner[name]"
                                   value="{{ old('owner.name') }}"
                                   class="mt-2 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                   required>
                            @error('owner.name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Owner Email --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="owner-email">Email</label>
                            <input id="owner-email" type="email" name="owner[email]"
                                   value="{{ old('owner.email') }}"
                                   class="mt-2 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                   required>
                            @error('owner.email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="owner-password">Password</label>
                            <input id="owner-password" type="password" name="owner[password]"
                                   class="mt-2 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                   required>
                            @error('owner.password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Confirm --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="owner-password-confirmation">Confirm Password</label>
                            <input id="owner-password-confirmation" type="password" name="owner[password_confirmation]"
                                   class="mt-2 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                   required>
                            @error('owner.password_confirmation')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex items-center justify-end gap-3">
                    <a href="{{ route('company.index') }}"
                       class="text-sm font-medium text-gray-600 hover:text-gray-800">Cancel</a>
                    <button type="submit"
                            class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
