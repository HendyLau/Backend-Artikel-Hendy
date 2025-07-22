<div>
    
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-bold mb-4">{{ __('Edit') }}</h2>

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

               

                {{-- Content --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">{{ __('Body') }}</label>
                    <textarea wire:model="body" class="w-full border-gray-300 rounded px-3 py-2" rows="6"></textarea>
                    @error('body') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
              
                

                {{-- Buttons --}}
              <div class="flex justify-between items-center mt-6">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                {{ __('Save') }}
            </button>
             <a href="{{ route('pages.index') }}"
                    
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        {{ __('Back') }}
             </a>
             </div> 
            </form>
        </div>
   
</div>
