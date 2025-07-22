<aside class="w-64 bg-gray-800 text-white flex flex-col">
    <div class="p-4 text-2xl font-bold border-b border-gray-700">
        CMS Admin
    </div>
    

    <nav class="flex-1 p-4 space-y-2">
        <a href="{{ route('admin.dashboard') }}" class="block py-2 px-3 rounded hover:bg-gray-700">{{ __('app.Dashboard') }}</a>
        <a href="" class="block py-2 px-3 rounded hover:bg-gray-700">{{ __('Posts') }}</a>
        <a href="" class="block py-2 px-3 rounded hover:bg-gray-700">{{ __('Pages') }}</a>
        <a href="" class="block py-2 px-3 rounded hover:bg-gray-700">{{ __('Categories') }}</a>
         <a href="" class="block py-2 px-3 rounded hover:bg-gray-700">{{ __('Videos') }}</a>
        <a href="" class="block py-2 px-3 rounded hover:bg-gray-700">{{ __('Profile') }}</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full text-left py-2 px-3 hover:bg-gray-700 rounded">{{ __('Logout') }}</button>
        </form>
    </nav>
</aside>
