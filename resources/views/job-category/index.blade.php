<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Job Categories') }} --}}
            Job Categories {{ ( request()->input("archived")=="true" ? "(Archived)":"(Active)") }}
        </h2>
    </x-slot>

<x-toast-notifications />



    <div class="overflow-x-auto p-6 ">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

    <div class="flex justify-end items-center space-x-4">
    
    @if (request()->input("archived")=="true" )
         <div class="flex justify-end mb-4">
            <a href="{{ route('category.index') }}"
            class="inline-flex items-center px-4 py-2 bg-black text-white text-sm font-medium rounded-lg shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-1 transition">
                Active
            </a>
        </div>
    @else
         <div class="flex justify-end mb-4">
            <a href="{{ route('category.index','archived=true') }}"
            class="inline-flex items-center px-4 py-2 bg-black text-white text-sm font-medium rounded-lg shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-1 transition">
                Archived
            </a>
        </div>
    @endif
   
        <div class="flex justify-end mb-4">
            <a href="{{ route('category.create') }}"
            class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-1 transition">
                ➕ New Category
            </a>
        </div>
    </div>

            <div class="bg-white shadow-sm rounded-2xl border border-gray-100 overflow-hidden">
                <table class="min-w-full">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-sm font-semibold text-gray-700 uppercase tracking-wide text-center">
                                Name
                            </th>
                            <th class="px-6 py-3 text-sm font-semibold text-gray-700 uppercase tracking-wide text-center">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($categories as $item)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-3 text-sm text-gray-800 text-center">{{ $item->name }}</td>
                                <td class="px-6 py-3 text-sm text-center">
                                @if (request()->input("archived")=="true" )
                                <form method="POST" action="{{ route('category.restore', $item->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-800 flex items-center gap-1">
                                        🔄<span>Restore</span>
                                    </button>
                                </form>
                                @else
                                <div class="flex items-center justify-center gap-3">
                                        <a href="{{ route('category.edit', $item->id) }}"
                                           class="text-blue-600 hover:text-blue-800 flex items-center gap-1">
                                           ✍️ <span>Edit</span>
                                        </a>
                                        <form method="POST" action="{{ route('category.destroy', $item->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-800 flex items-center gap-1">
                                                🗃️ <span>Archive</span>
                                            </button>
                                        </form>
                                </div>
                                @endif 
                                    
                                </td>
                            </tr>
                            @empty
                            No Data to show
                        @endforelse

                        
                    </tbody>
                </table>                
            </div>
            <div class="mt-4">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
