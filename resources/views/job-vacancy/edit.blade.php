{{-- resources/views/job-vacancy/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create Job Vacancy') }}
            </h2>

            <a href="{{ route('job-vacancy.index') }}"
               class="inline-flex items-center px-3 py-1.5 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg shadow-sm hover:bg-gray-200">
                ⬅️ Back
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-2xl border border-gray-100 p-6">
                @php
                    // fallback إذا ما تم تمرير $types من الكنترولر
                    $types = $types ?? ['Full-Time','Contract','Remote','Hybrid'];
                @endphp

                <form method="POST" action="{{ route('job-vacancy.update',['job_vacancy'=>$job_vacancy,'redirectToList'=>request('redirectToList')]) }}" class="space-y-6">
                    @csrf
                    @method("PUT")
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        {{-- Title --}}
                        <div class="sm:col-span-2">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input id="title" type="text" name="title"
                                   value="{{ old('title',$job_vacancy->title) }}"
                                   class="mt-2 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                   required>
                            @error('title')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Company --}}
                        <div>
                            <label for="companyId" class="block text-sm font-medium text-gray-700">Company</label>
                            <select id="companyId" name="companyId"
                                    class="mt-2 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                    required>
                                <option value="" disabled {{ old('companyId',$job_vacancy->companyId) ? '' : 'selected' }}>Select company…</option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" {{ old('companyId',$job_vacancy->companyId) == $company->id ? 'selected' : '' }}>
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('companyId')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Category --}}
                        <div>
                            <label for="categoryId" class="block text-sm font-medium text-gray-700">Category</label>
                            <select id="categoryId" name="categoryId"
                                    class="mt-2 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                    required>
                                <option value="" disabled {{ old('categoryId',$job_vacancy->categoryId) ? '' : 'selected' }}>Select category…</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('categoryId',$job_vacancy->categoryId) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categoryId')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Type --}}
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                            <select id="type" name="type"
                                    class="mt-2 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                    required>
                                <option value="" disabled {{ old('type',$job_vacancy->type) ? '' : 'selected' }}>Select type…</option>
                                @foreach($types as $t)
                                    <option value="{{ $t }}" {{ old('type',$job_vacancy->type) === $t ? 'selected' : '' }}>
                                        {{ $t }}
                                    </option>
                                @endforeach
                            </select>
                            @error('type')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Location --}}
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                            <input id="location" type="text" name="location"
                                   value="{{ old('location',$job_vacancy->location) }}"
                                   class="mt-2 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            @error('location')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Salary --}}
                        <div>
                            <label for="salary" class="block text-sm font-medium text-gray-700">Salary</label>
                            <input id="salary" type="number" step="0.01" name="salary"
                                   value="{{ old('salary',$job_vacancy->salary) }}"
                                   class="mt-2 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            @error('salary')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="sm:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea id="description" name="description" rows="5"
                                      class="mt-2 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                      required>{{ old('description',$job_vacancy->description) }}</textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-2">
                        <a href="{{ route('job-vacancy.index') }}"
                           class="text-sm font-medium text-gray-600 hover:text-gray-800">Cancel</a>
                        <button type="submit"
                                class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
