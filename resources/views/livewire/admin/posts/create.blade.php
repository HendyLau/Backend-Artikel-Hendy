<div>
 
    <div class="max-w-3xl mx-auto bg-white p-6 shadow rounded">
        <h2 class="text-xl font-bold mb-4">{{ __('Create Post') }}</h2>

        <form wire:submit.prevent="save">
            <div class="mb-4">
                <label class="block mb-1">{{ __('Title') }}</label>
                <input wire:model="title" type="text" class="w-full border rounded px-3 py-2" />
                @error('title') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1">{{ __('Slug') }}</label>
                <input wire:model="slug" type="text" class="w-full border rounded px-3 py-2 bg-gray-100" readonly />
                @error('slug') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1">{{ __('Short Description') }}</label>
                <textarea wire:model="short_description" class="w-full border rounded px-3 py-2"></textarea>
            </div>

            <div class="mb-4">
                <label class="block mb-1">{{ __('Content') }}</label>
                <textarea wire:model="content" class="w-full border rounded px-3 py-2" rows="5"></textarea>
                @error('content') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>         

           

                {{-- Categories (Dropdown Checkbox Multiselect) --}}
                    <div x-data="{ open: false }" class="mb-4 relative">
                <label class="block font-medium mb-1">{{ __('Category') }}</label>

                <!-- Trigger -->
                <div @click="open = !open"
                    class="border border-gray-300 bg-white px-4 py-2 rounded cursor-pointer">
                    {{ count($selectedCategories)
                        ? implode(', ', $categories->whereIn('id', $selectedCategories)->pluck('name')->toArray())
                        : __('Select Categories') }}
                </div>

                <!-- Dropdown -->
                <div x-show="open" @click.outside="open = false"
                    class="absolute z-10 mt-2 w-full bg-white border border-gray-300 rounded shadow max-h-60 overflow-y-auto">
                    @foreach($categories as $category)
                        <label class="flex items-center px-4 py-2 hover:bg-gray-100">
                            <input type="checkbox" wire:model="selectedCategories" value="{{ $category->id }}" class="mr-2">
                            {{ $category->name }}
                        </label>
                    @endforeach
                </div>
            </div>


   

            <div class="mb-4">
                <label class="block mb-1">{{ __('Image') }}</label>
                <input type="file" wire:model="image" class="w-full" />
                @error('image') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1">{{ __('Status') }}</label>
                <select wire:model="status" class="w-full border rounded px-3 py-2">
                    <option value="draft">{{ __('Draft') }}</option>
                    <option value="published">{{ __('Published') }}</option>
                </select>
                @error('status') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1">{{ __('Publish Date') }}</label>
                <input wire:model="published_at" type="datetime-local" class="w-full border rounded px-3 py-2" />
                @error('published_at') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            
            <div class="flex justify-between items-center mt-6">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                {{ __('Save') }}
            </button>
             <a href="{{ route('posts.index') }}"
                    
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        {{ __('Back') }}
             </a>
             </div> 
        </form>
    </div>


</div>
