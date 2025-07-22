<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Admin\Categories\Index as CategoriesIndex;

use App\Http\Livewire\Admin\Categories\Create as CategoriesCreate;
use App\Http\Livewire\Admin\Categories\Edit as CategoriesEdit;

use App\Http\Livewire\Admin\Posts\Index as PostsIndex;
use App\Http\Livewire\Admin\Posts\Create as CreatePost;
use App\Http\Livewire\Admin\Posts\Edit as EditPost;

use App\Http\Livewire\Admin\Videos\Index as VideosIndex;
use App\Http\Livewire\Admin\Videos\Create as CreateVideos;
use App\Http\Livewire\Admin\Videos\Edit as EditVideos;

use App\Http\Livewire\Admin\Pages\Index as PagesIndex;
use App\Http\Livewire\Admin\Pages\Create as CreatePages;
use App\Http\Livewire\Admin\Pages\Edit as EditPages;

use App\Http\Controllers\Auth\SocialAuthController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    return redirect()->route('login');
});



Route::middleware(['auth'])->group(function () {
   Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/categories', CategoriesIndex::class)->name('categories.index');
    Route::get('/categories/create', CategoriesCreate::class)->name('categories.create');
   Route::get('/categories/{id}/edit', CategoriesEdit::class)->name('categories.edit');
    
   Route::get('/posts', PostsIndex::class)->name('posts.index');
   Route::get('/posts/create', CreatePost::class)->name('posts.create');
   Route::get('/posts/{id}/edit', EditPost::class)->name('posts.edit');

   Route::get('/pages', PagesIndex::class)->name('pages.index');
   Route::get('/pages/create', CreatePages::class)->name('pages.create');
   Route::get('/pages/{id}/edit', EditPages::class)->name('pages.edit');
 
   Route::get('/vidoes', VideosIndex::class)->name('videos.index');
    Route::get('/vidoes/create', CreateVideos::class)->name('videos.create');
   Route::get('/vidoes/{id}/edit', EditVideos::class)->name('videos.edit');
     
});
Route::get('/auth/facebook/callback', [SocialAuthController::class, 'handleFacebookCallback']);
Route::prefix('api/auth')->group(function () {
    Route::get('/google/redirect', [SocialAuthController::class, 'redirectToGoogle']);
    Route::get('/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);
   
Route::get('/auth/facebook', [SocialAuthController::class, 'redirectToFacebook']);


    
});
Route::get('lang/{locale}', function ($locale) {
    session(['user_locale' => $locale]);
    app()->setLocale($locale);
    return redirect()->back();
})->name('lang.switch');

require __DIR__.'/auth.php';
