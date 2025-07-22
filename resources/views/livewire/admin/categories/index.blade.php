<div>

    
<div class="p-6 bg-white shadow rounded-lg">

        @if (session()->has('success'))
            <div class="mb-4 text-green-600">
                {{ session('success') }}
            </div>
        @endif
            
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">{{ __('Categories') }}</h2>
       <a href="{{ route('categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            {{ __('Add') }}    
        </a>

        
    </div>

    <!-- Search Input -->
    <div class="mb-4">
        <input
    type="text"
    wire:model.debounce.500ms="search"
    placeholder="{{ __('Search') }}"
    class="border-gray-300 rounded w-full px-4 py-2"
/>

    </div>
     <div class="flex center-between items-center mb-8">
@if ($confirmingCategoryDeletion)
             <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40">
               <div class="bg-white rounded-lg shadow-lg w-96 p-6">
                    <h3 class="text-lg font-semibold mb-3">{{ __('Delete Confirmation') }}</h3>
                    <p>{{ __('Are you sure you want to delete this category?') }}</p>
                    <div class="mt-5 flex justify-end gap-3">
                        <button wire:click="deleteCategory"
                            class="bg-red-600 text-white px-3 py-1.5 rounded hover:bg-red-700 text-sm">
                            {{ __('Yes, Delete') }}
                        </button>
                        <button wire:click="$set('confirmingCategoryDeletion', false)"
                            class="bg-gray-300 px-3 py-1.5 rounded hover:bg-gray-400 text-sm">
                            {{ __('Cancel') }}
                        </button>
                    </div>
                </div>
            </div>
        @endif
        </div>
    <!-- Table -->
    <table class="w-full table-auto border-collapse">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="px-4 py-2">{{ __('Name') }}</th>
                <th class="px-4 py-2">{{ __('Slug') }}</th>
                <th class="px-4 py-2 w-32 text-center">{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2">  {{ translate($category->name, $post->locale ?? 'en', session('user_locale')) }}</td>
                     <td class="px-4 py-2">  {{ translate($category->slug, $post->locale ?? 'en', session('user_locale')) }}</td>
                     
                   
                    <td class="px-4 py-2 text-center">
                       <a href="{{ route('categories.edit', encrypt($category->id)) }}"
                        class="text-indigo-600 hover:underline mr-2">
                            {{ __('Edit') }}
                        </a>
                        <button wire:click="$emit('confirmDelete', '{{ encrypt($category->id) }}')" class="text-red-600 hover:underline">
                            {{ __('Delete') }}
                        </button>
                        
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center px-4 py-4 text-gray-500">
                        {{ __('No categories found.') }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
 
    <!-- Pagination -->
    <div class="mt-4">
        {{ $categories->links() }}
    </div>
       

     
</div>




</div>







