<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               {{ $application->user->name }} | Applied to  {{ $application->jobVacancy->title }}
            </h2>

            <div class="flex gap-2">
                <a href="{{ route('application.edit', ['application'=>$application->id,"redirectToList"=>"false"]) }}"
                   class="inline-flex items-center px-3 py-1.5 bg-indigo-600 text-white text-sm font-medium rounded-md shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    ✏️ Edit
                </a>

                <form method="POST" action="{{ route('application.destroy', $application->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 text-sm font-medium rounded-md shadow-sm hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-300">
                        🗃️ Archive
                    </button>
                </form>

                <a href="{{ route('application.index') }}"
                   class="inline-flex items-center px-3 py-1.5 bg-gray-100 text-gray-700 text-sm font-medium rounded-md shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    ⬅️ Back
                </a>
            </div>
        </div>
    </x-slot>
<x-toast-notifications />

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-2xl border border-gray-100 p-6">

                <!-- Job Application info -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">Job Application Details</h3>
                    <p class="text-sm text-gray-600 mt-2">
                        <span class="font-medium">Seeker:</span> {{ $application->user->name ?? '—' }}<br>
                        <span class="font-medium">Vacancy:</span> {{ $application->jobVacancy->title ?? '—' }}<br>
                        <span class="font-medium">Company:</span> {{ $application->jobVacancy->company->name ?? '—' }}<br> 
                        <span class="font-medium">Status:</span> {{  $application->status ?? '—' }}<br>                        
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
                </div>

                <!-- Tabs Navigation -->
                @php
                    $tab = request('tab', 'resume'); // default to jobs
                @endphp

                <div class="border-b border-gray-200 mb-6">
                    <nav class="-mb-px flex space-x-6">
                 
                        <a href="{{ route('application.show', ['application' => $application->id, 'tab' => 'resume']) }}"
                           class="py-2 px-3 border-b-2 text-sm font-medium {{ $tab === 'resume' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            Resume
                        </a>
                    </nav>
                </div>

                <!-- Tabs Content -->
                @if ($tab === 'resume')
                    <!-- Job Applications Tab -->
                    <div>
                        <h3 class="text-md font-semibold text-gray-800 mb-3">Applications</h3>

                        @if ($application->resume->count())
                            <table class="min-w-full bg-white border border-gray-100 rounded-lg shadow-sm">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="text-left px-4 py-2 text-sm font-semibold text-gray-700">Skills</th>
                                        <th class="text-left px-4 py-2 text-sm font-semibold text-gray-700">Experience</th>
                                        <th class="text-left px-4 py-2 text-sm font-semibold text-gray-700">Education</th>
                                        <th class="text-left px-4 py-2 text-sm font-semibold text-gray-700">Contact Details</th>
                                        <th class="text-left px-4 py-2 text-sm font-semibold text-gray-700">Summary</th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-4 py-2 text-sm text-gray-800">{{$application->resume->skills?? '—' }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-600">{{$application->resume->experience?? '—' }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-600">{{$application->resume->education ?? '—' }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-600">{{$application->resume->contactDetails?? '—' }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-600">{{$application->resume->summary ?? '—'}}</td>
                                        </tr>
                                </tbody>
                            </table>
                        @else
                            <p class="text-gray-500 text-sm">No resume found for this vacancy.</p>
                        @endif
                    </div>
                @else
                 
                    
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
