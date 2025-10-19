<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Analytics') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 space-y-8">

                    {{-- === Summary Cards === --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-gray-50 rounded-lg border p-5 shadow-sm">
                            <p class="text-gray-500 text-sm mb-1">Active Users</p>
                            <h3 class="text-2xl font-bold">{{ $cards["activeUser"] }}</h3>
                            <p class="text-gray-400 text-xs">Last 30 days</p>
                        </div>

                        <div class="bg-gray-50 rounded-lg border p-5 shadow-sm">
                            <p class="text-gray-500 text-sm mb-1">Active Job Postings</p>
                            <h3 class="text-2xl font-bold">{{ $cards["activeJobPosting"] }}</h3>
                            <p class="text-gray-400 text-xs">Currently active</p>
                        </div>

                        <div class="bg-gray-50 rounded-lg border p-5 shadow-sm">
                            <p class="text-gray-500 text-sm mb-1">Total Applications</p>
                            <h3 class="text-2xl font-bold">{{ $cards["totalApplication"] }}</h3>
                            <p class="text-gray-400 text-xs">All time</p>
                        </div>
                    </div>

                    {{-- === Most Applied Jobs === --}}
                    <div class="bg-white rounded-lg border shadow-sm p-6">
                        <h3 class="text-lg font-semibold mb-4">Most Applied Jobs</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm text-left text-gray-700">
                                <thead class="bg-gray-100 border-b">
                                    <tr>
                                        <th class="px-4 py-2">Job Title</th>
                                        <th class="px-4 py-2">Company</th>
                                        <th class="px-4 py-2">Applications</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($mostAppliedJobs as $job)
                                    <tr class="border-b">
                                        <td class="px-4 py-2">{{ $job->title }}</td>
                                        <td class="px-4 py-2">{{ $job->company->name }}</td>
                                        <td class="px-4 py-2">{{ $job->totalCount }}</td>
                                    </tr>
                                  
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- === Top Converting Jobs === --}}
                    <div class="bg-white rounded-lg border shadow-sm p-6">
                        <h3 class="text-lg font-semibold mb-4">Top Converting Job Posts</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm text-left text-gray-700">
                                <thead class="bg-gray-100 border-b">
                                    <tr>
                                        <th class="px-4 py-2">Job Title</th>
                                        <th class="px-4 py-2">Views</th>
                                        <th class="px-4 py-2">Applications</th>
                                        <th class="px-4 py-2">Conversion Rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($topConvertingJobs as $job)
                                    <tr class="border-b">
                                        <td class="px-4 py-2">{{ $job->title }}</td>
                                        <td class="px-4 py-2">{{ $job->viewCount }}</td>
                                        <td class="px-4 py-2">{{ $job->totalCount }}</td>
                                        <td class="px-4 py-2">{{ number_format($job->ConvertingRate,2) }}%</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
