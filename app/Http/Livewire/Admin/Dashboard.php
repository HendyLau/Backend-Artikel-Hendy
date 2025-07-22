<?php

namespace App\Http\Livewire\Admin;

use App\Models\Post;
use App\Models\Video;
use App\Models\Page;
use App\Models\Category;
use Livewire\Component;

class Dashboard extends Component
{
    public $postCount;
     public $videoCount;
    public $pageCount;
    public $categoryCount;

    public function mount()
    {
        $this->postCount = Post::count();
         $this->videoCount = Video::count();
        $this->pageCount = Page::count();
        $this->categoryCount = Category::count();
    }

    public function render()
{
    $monthlyPosts = Post::selectRaw("DATE_FORMAT(published_at, '%Y-%m') as month, COUNT(*) as count")
        ->whereNotNull('published_at')
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('count', 'month');

    $videoPosts = Video::selectRaw("DATE_FORMAT(published_at, '%Y-%m') as month, COUNT(*) as count")
        ->whereNotNull('published_at')
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('count', 'month');


    $statusBreakdown = Post::selectRaw('status, COUNT(*) as count')
        ->groupBy('status')
        ->pluck('count', 'status');

    return view('livewire.admin.dashboard', [
        'postCount' => Post::count(),
        'pageCount' => Page::count(),
        'categoryCount' => Category::count(),
        'monthlyPosts' => $monthlyPosts,
        'statusBreakdown' => $statusBreakdown,
    ])->layout('components.layouts.admin', [
        'activeMenu' => 'dashboard',
    ]);
}

}
