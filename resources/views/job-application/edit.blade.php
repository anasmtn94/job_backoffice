{{-- resources/views/job-vacancy/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Job Application') }}
            </h2>

            <a href="{{ route('application.index') }}"
               class="inline-flex items-center px-3 py-1.5 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg shadow-sm hover:bg-gray-200">
                ⬅️ Back
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-2xl border border-gray-100 p-6">
                <form method="POST" action="{{ route('application.update',['application'=>$application,'redirectToList'=>request('redirectToList')]) }}" class="space-y-6">
                    @csrf
                    @method("PUT")
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                    <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">Job Application Details</h3>
                    <p class="text-sm text-gray-600 mt-2">
                        <span class="font-medium">Seeker:</span> {{ $application->user->name ?? '—' }}<br>
                        <span class="font-medium">Vacancy:</span> {{ $application->jobVacancy->title ?? '—' }}<br>
                        <span class="font-medium">Company:</span> {{ $application->jobVacancy->company->name ?? '—' }}<br>                                    
                        <span class="font-medium">Resume:</span>
                            <a href="{{  $application->resume->fileUri }}"
                                class="inline-flex items-center px-3 py-1.5 bg-indigo-600 text-white text-sm font-medium rounded-md shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                 {{ $application->resume->filename ?? '—' }}
                            </a>
                        <br>                         
                    </p>
                    <h3 class="text-lg font-semibold text-gray-800">AI Feedback Details</h3>
                    <p class="text-sm text-gray-600 mt-2">
                    <span class="font-medium">AI Score:</span> {{ $application->aiGeneratedScore ?? '—' }}<br>
                    <span class="font-medium">AI Feedback:</span> {{ $application->aiGeneratedFeedback ?? '—' }}<br>
                    </p>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select id="status" name="status"
                                    class="mt-2 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                    required>
                                <option value="" disabled {{ old('status',$application->status) ? '' : 'selected' }}>Select status…</option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status }}" {{ old('status',$application->status) == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                     
                    </div>


            
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-2">
                        <a href="{{ route('application.index') }}"
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
