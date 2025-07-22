
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'CMS') }}</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @livewireStyles
</head>
<body class="bg-gray-100 text-gray-900">

@php
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Str;

    $currentRoute = Route::currentRouteName();
@endphp
 @include('layouts.navigation')

<div class="min-h-screen flex">
    <!-- Sidebar -->
 <aside class="w-64 bg-gray-800 text-white shadow-lg">
    <div class="p-4 font-bold text-xl border-b border-gray-700">
        {{ config('app.name') }}
    </div>
    <nav class="p-4 space-y-1">

        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
           class="flex items-center px-4 py-2 rounded-lg transition duration-200
           {{ request()->routeIs('dashboard') 
               ? 'bg-blue-600 text-white font-bold' 
               : 'hover:bg-gray-700 hover:text-white text-gray-300' }}">
            <span class="material-icons mr-2">🏠</span>
            {{ __('Dashboard') }}
        </a>

        {{-- Categories --}}
        <a href="{{ route('categories.index') }}"
           class="flex items-center px-4 py-2 rounded-lg transition duration-200
           {{ request()->is('categories*') 
               ? 'bg-blue-600 text-white font-bold' 
               : 'hover:bg-gray-700 hover:text-white text-gray-300' }}">
            <span class="material-icons mr-2">📁</span>
            {{ __('Categories') }}
        </a>

        {{-- Posts --}}
        <a href="{{ route('posts.index') }}"
           class="flex items-center px-4 py-2 rounded-lg transition duration-200
           {{ request()->is('posts*') 
               ? 'bg-blue-600 text-white font-bold' 
               : 'hover:bg-gray-700 hover:text-white text-gray-300' }}">
            <span class="material-icons mr-2">📝</span>
            {{ __('Posts') }}
        </a>

           {{-- Videos --}}
        <a href="{{ route('videos.index') }}"
           class="flex items-center px-4 py-2 rounded-lg transition duration-200
           {{ request()->is('videos*') 
               ? 'bg-blue-600 text-white font-bold' 
               : 'hover:bg-gray-700 hover:text-white text-gray-300' }}">
            <span class="material-icons mr-2">📝</span>
            {{ __('Videos') }}
        </a>

         {{-- Pages --}}
        <a href="{{ route('pages.index') }}"
           class="flex items-center px-4 py-2 rounded-lg transition duration-200
           {{ request()->is('pages*') 
               ? 'bg-blue-600 text-white font-bold' 
               : 'hover:bg-gray-700 hover:text-white text-gray-300' }}">
            <span class="material-icons mr-2">📘</span>
            {{ __('Pages') }}
        </a>
    </nav>
    
</aside>


    <!-- Main Content -->
    <main class="flex-1 p-6">
        {{ $slot }}
        
    </main>
</div>

@livewireScripts
<script src="{{ mix('js/app.js') }}" defer></script>
</body>
</html>
