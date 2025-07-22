<div>
    
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-bold mb-4">{{ __('Edit Post') }}</h2>

            <form wire:submit.prevent="update">
                {{-- Title --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">{{ __('Title') }}</label>
                    <input type="text" wire:model="title" class="w-full border-gray-300 rounded px-3 py-2" />
                    @error('title') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Slug (readonly) --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">{{ __('Slug') }}</label>
                    <input type="text" wire:model="slug" class="w-full border-gray-300 rounded px-3 py-2 bg-gray-100" readonly />
                    @error('slug') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Short Description --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">{{ __('Short Description') }}</label>
                    <textarea wire:model="short_description" class="w-full border-gray-300 rounded px-3 py-2" rows="2"></textarea>
                    @error('short_description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Content --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">{{ __('Content') }}</label>
                    <textarea wire:model="content" class="w-full border-gray-300 rounded px-3 py-2" rows="6"></textarea>
                    @error('content') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                 {{-- Categories (Dropdown Multiselect) --}}
                <div x-data="{ open: false }" class="mb-4 relative" wire:ignore>
                    <label class="block text-sm font-medium mb-1">{{ __('Categories') }}</label>

                    <div @click="open = !open"
                        class="border border-gray-300 bg-white px-4 py-2 rounded cursor-pointer">
                        {{ count($selectedCategories)
                            ? implode(', ', $categories->whereIn('id', $selectedCategories)->pluck('name')->toArray())
                            : __('Select Categories') }}
                    </div>

                    <div x-show="open" @click.outside="open = false" x-transition
                        class="absolute z-10 mt-2 w-full bg-white border border-gray-300 rounded shadow max-h-60 overflow-y-auto">
                        @foreach($categories as $category)
                            <label class="flex items-center px-4 py-2 hover:bg-gray-100">
                                <input type="checkbox" wire:model="selectedCategories" value="{{ $category->id }}" class="mr-2">
                                {{ $category->name }}
                            </label>
                        @endforeach
                    </div>
                </div>


                {{-- Image Upload --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">{{ __('Image') }}</label>
                    <input type="file" wire:model="image" class="w-full border-gray-300 rounded px-3 py-2" />
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="h-16 mt-2 rounded shadow">
                    @endif
                    @error('image') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Status --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">{{ __('Status') }}</label>
                    <select wire:model="status" class="w-full border-gray-300 rounded px-3 py-2">
                        <option value="draft">{{ __('Draft') }}</option>
                        <option value="published">{{ __('Published') }}</option>
                    </select>
                    @error('status') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Published At --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">{{ __('Published At') }}</label>
                     <input wire:model="publishedAtForInput" type="datetime-local" class="w-full border rounded px-3 py-2" />
                     @error('publishedAtForInput') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                

                {{-- Buttons --}}
                <div class="flex justify-between items-center mt-6">
                    
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
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
