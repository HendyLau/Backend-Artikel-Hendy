<div>
 
    <div class="max-w-3xl mx-auto bg-white p-6 shadow rounded">
        <h2 class="text-xl font-bold mb-4">{{ __('Create') }}</h2>

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
                <label class="block mb-1">{{ __('Body') }}</label>
                <textarea wire:model="body" class="w-full border rounded px-3 py-2" rows="5"></textarea>
                @error('body') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>      
                                
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
