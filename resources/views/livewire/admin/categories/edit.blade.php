<div>
  
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">{{ __('Edit') }}</h2>

        <form wire:submit.prevent="update">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                <input type="text" wire:model="name" class="w-full border-gray-300 rounded px-3 py-2" />
                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">{{ __('Slug') }}</label>
                <input type="text" wire:model="slug" class="w-full border-gray-300 rounded px-3 py-2 bg-gray-100" readonly />
                @error('slug') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

           <div class="flex justify-between items-center mt-6">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                {{ __('Save') }}
            </button>
             <a href="{{ route('categories.index') }}"
                    
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        {{ __('Back') }}
             </a>
             </div> 
        </form>
    </div>


</div>
