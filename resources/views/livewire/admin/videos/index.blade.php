<div>

    
<div class="p-6 bg-white shadow rounded-lg">

        @if (session()->has('success'))
            <div class="mb-4 text-green-600">
                {{ session('success') }}
            </div>
        @endif
            
    <div class="flex justify-between items-center mb-4">
         <h2 class="text-xl font-semibold">{{ __('Videos') }}</h2>
            <a href="{{ route('videos.create') }}"
              class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                {{ __('Add') }}
            </a>

        
    </div>

    <!-- Search Input -->
    <div class="mb-4">       
         <input
            type="text"
            wire:model.debounce.500ms="search"
            placeholder="{{ __('Search') }}"
            class="px-4 py-2 border rounded w-full sm:max-w-xs flex-grow"
        />
    </div>
    <div class="flex center-between items-center mb-8">
         {{-- Modal --}}
        @if ($confirmingPostDeletion)
            <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded shadow w-96">
                    <h3 class="text-lg font-semibold">{{ __('Delete Confirmation') }}</h3>
                    <p class="mt-2 text-gray-600">{{ __('Are you sure you want to delete this video?') }}</p>
                    <div class="mt-4 flex justify-end gap-2">
                        <button wire:click="deletePost"
                                class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 text-sm">
                            {{ __('Yes, Delete') }}
                        </button>
                        <button wire:click="$set('confirmingPostDeletion', false)"
                                class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400 text-sm">
                            {{ __('Cancel') }}
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>
   
        <!-- Table -->
        <table class="w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                      <th class="px-4 py-2">{{ __('URL') }}</th>
                    <th class="px-4 py-2">{{ __('Title') }}</th>
                    <th class="px-4 py-2">{{ __('Status') }}</th>
                    <th class="px-4 py-2">{{ __('Published At') }}</th>
                    <th class="px-4 py-2 text-center">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($videos as $video)
               

                    <tr class="border-t hover:bg-gray-50">
                      
                         <td class="px-4 py-2">
                          
                            @if ($video->url)
                                <img src="{{ asset('storage/' . $video->url) }}" alt="Image" 
                                    class="h-12 w-12 object-cover rounded mx-auto" />
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </td>
                        
                        <td class="px-4 py-2">  {{ translate($video->title, $video->locale ?? 'en', session('user_locale')) }}</td>
                        <td class="px-4 py-2">{{ translate(ucfirst($video->status), $video->locale ?? 'en', session('user_locale')) }}</td>
                        <td class="px-4 py-2"> {{ \Carbon\Carbon::parse($video->published_at)->translatedFormat('d F Y') }}</td>
                        
                        <td class="px-4 py-2 text-center">
                            <a href="{{ route('videos.edit', encrypt($video->id)) }}"
                               class="text-indigo-600 hover:underline mr-2">{{ __('Edit') }}</a>
                            <button wire:click="$emit('confirmDelete', '{{ encrypt($video->id) }}')"
                                    class="text-red-600 hover:underline">{{ __('Delete') }}</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-gray-500">{{ __('No posts found.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    <div class="mt-4">{{ $videos->links() }}</div>     
     
</div>


</div>













