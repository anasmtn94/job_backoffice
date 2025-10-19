<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $company->name }}
            </h2>

            <div class="flex gap-2">
                <a href="{{ route('company.edit', ['company'=>$company->id,"redirectToList"=>"false"]) }}"
                   class="inline-flex items-center px-3 py-1.5 bg-indigo-600 text-white text-sm font-medium rounded-md shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    ✏️ Edit
                </a>

                <form method="POST" action="{{ route('company.destroy', $company->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 text-sm font-medium rounded-md shadow-sm hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-300">
                        🗃️ Archive
                    </button>
                </form>

                <a href="{{ route('company.index') }}"
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

                <!-- Company info -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">Company Details</h3>
                    <p class="text-sm text-gray-600 mt-2">
                        <span class="font-medium">Owner:</span> {{ $company->owner->name ?? '—' }}<br>
                        <span class="font-medium">Industry:</span> {{ $company->industry ?? '—' }}<br>
                        <span class="font-medium">Address:</span> {{ $company->address ?? '—' }}<br> 
                        <span class="font-medium">Website:</span> {{ $company->website ?? '—' }}<br>                        
                    </p>
                </div>

                <!-- Tabs Navigation -->
                @php
                    $tab = request('tab', 'jobs'); // default to jobs
                @endphp

                <div class="border-b border-gray-200 mb-6">
                    <nav class="-mb-px flex space-x-6">
                        <a href="{{ route('company.show', ['company' => $company->id, 'tab' => 'jobs']) }}"
                           class="py-2 px-3 border-b-2 text-sm font-medium {{ $tab === 'jobs' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            Jobs
                        </a>

                        <a href="{{ route('company.show', ['company' => $company->id, 'tab' => 'applications']) }}"
                           class="py-2 px-3 border-b-2 text-sm font-medium {{ $tab === 'applications' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            Job Applications
                        </a>
                    </nav>
                </div>

                <!-- Tabs Content -->
                @if ($tab === 'applications')
                    <!-- Job Applications Tab -->
                    <div>
                        <h3 class="text-md font-semibold text-gray-800 mb-3">Applications</h3>

                        @if ($company->jobApplications->count())
                            <table class="min-w-full bg-white border border-gray-100 rounded-lg shadow-sm">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="text-left px-4 py-2 text-sm font-semibold text-gray-700">Applicant</th>
                                        <th class="text-left px-4 py-2 text-sm font-semibold text-gray-700">Email</th>
                                        <th class="text-left px-4 py-2 text-sm font-semibold text-gray-700">Job Title</th>
                                        <th class="text-left px-4 py-2 text-sm font-semibold text-gray-700">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach ($company->jobApplications as $app)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-4 py-2 text-sm text-gray-800">{{ $app->user->name }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-600">{{ $app->user->email }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-600">{{ $app->jobVacancy->title ?? '—' }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-600">{{ $app->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-gray-500 text-sm">No applications found for this company.</p>
                        @endif
                    </div>
                @else
                    <!-- Jobs Tab -->
                    <div>
                        <h3 class="text-md font-semibold text-gray-800 mb-3">Job Vacancies</h3>

                        @if ($company->jobVacancies->count())
                            <table class="min-w-full bg-white border border-gray-100 rounded-lg shadow-sm">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="text-left px-4 py-2 text-sm font-semibold text-gray-700">Category</th>
                                        <th class="text-left px-4 py-2 text-sm font-semibold text-gray-700">Title</th>
                                        <th class="text-left px-4 py-2 text-sm font-semibold text-gray-700">Description</th>
                                        <th class="text-left px-4 py-2 text-sm font-semibold text-gray-700">Location</th>
                                        <th class="text-left px-4 py-2 text-sm font-semibold text-gray-700">Type</th>
                                        <th class="text-left px-4 py-2 text-sm font-semibold text-gray-700">Salary</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach ($company->jobVacancies as $job)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-4 py-2 text-sm text-gray-600">{{ $job->jobCategory->name ?? '—' }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-800">{{ $job->title }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-800">{{ $job->description }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-800">{{ $job->location }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-800">{{ $job->type }}</td>
                                            <td class="px-4 py-2 text-sm text-gray-800">{{ $job->salary }}</td>                                                                                    
                                            <td class="px-4 py-2 text-sm">
                                                {{-- <span class="px-2 py-1 rounded-full text-xs {{ $job->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                                    {{ ucfirst($job->status) }}
                                                </span> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-gray-500 text-sm">No job vacancies found for this company.</p>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
