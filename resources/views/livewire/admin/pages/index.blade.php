<div>
    <div class="bg-white p-6 rounded shadow">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">{{ __('Pages') }}</h2>
            <a href="{{ route('pages.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                {{ __('Add') }}
            </a>
        </div>

        <!-- Search -->
        <div class="mb-4">
            <input type="text" wire:model.debounce.500ms="search"
                placeholder="{{ __('Search') }}"
                class="w-full border-gray-300 rounded px-4 py-2">
        </div>

        <!-- Delete Confirmation -->
        @if ($confirmingPageDeletion)
            <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded shadow w-96">
                    <h3 class="text-lg font-semibold">{{ __('Delete Confirmation') }}</h3>
                    <p class="mt-2 text-gray-600">{{ __('Are you sure you want to delete this page?') }}</p>
                    <div class="mt-4 flex justify-end gap-2">
                        <button wire:click="deletePage" class="bg-red-600 text-white px-4 py-2 rounded text-sm hover:bg-red-700">
                            {{ __('Yes, Delete') }}
                        </button>
                        <button wire:click="$set('confirmingPageDeletion', false)"
                            class="bg-gray-300 px-4 py-2 rounded text-sm hover:bg-gray-400">
                            {{ __('Cancel') }}
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <!-- Table -->
        <table class="w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">{{ __('Title') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('Body') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('Slug') }}</th>
                    <th class="px-4 py-2 text-center">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pages as $page)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-2">
                            {{ translate($page->title, $page->locale ?? 'en', session('user_locale')) }}
                        </td>
                        <td class="px-4 py-2">
                            {{ translate(ucfirst($page->body), $page->locale ?? 'en', session('user_locale')) }}
                        </td>
                        <td class="px-4 py-2">
                            {{ translate(ucfirst($page->slug), $page->locale ?? 'en', session('user_locale')) }}
                        </td>
                        <td class="px-4 py-2 text-center">
                            <a href="{{ route('pages.edit', encrypt($page->id)) }}"
                               class="text-indigo-600 hover:underline mr-2">{{ __('Edit') }}</a>
                            <button wire:click="$emit('confirmDelete', '{{ encrypt($page->id) }}')"
                                    class="text-red-600 hover:underline">{{ __('Delete') }}</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-4 text-center text-gray-500">{{ __('No pages found.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $pages->links() }}
        </div>
    </div>
</div>
