<?php

namespace App\Http\Livewire\Admin\Posts;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class Create extends Component
{
    use WithFileUploads;

    public $title, $slug, $content, $short_description, $image, $status = 'draft', $published_at;
    public $selectedCategories = [];
    public $locale;

    public function mount()
{
    $this->locale = session('user_locale', 'en');
    $this->categories = Category::all();
}

    protected $rules = [
        'title' => 'required|min:3',
        'slug' => 'required|unique:posts,slug',
        'short_description' => 'nullable|string|max:255',
        'content' => 'required|string',
        'image' => 'nullable|image|max:2048',
        'status' => 'required|in:draft,published',
        'published_at' => 'nullable|date',
        'selectedCategories' => 'required|array|min:1',
    ];

    public function updatedTitle()
    {
        $this->slug = Str::slug($this->title);
    }

    public function save()
    {
        $this->validate();

        $post = Post::create([
            'title' => $this->title,
            'slug' => $this->slug,
            'short_description' => $this->short_description,
            'content' => $this->content,
            'status' => $this->status,
            'published_at' => $this->published_at ?? now(),
            'image' => $this->image ? $this->image->store('posts', 'public') : null,
            'locale' => session('user_locale', 'en'),
            
        ]);

       $post->categories()->sync($this->selectedCategories);

        session()->flash('success', __('Post created successfully.'));
        return redirect()->route('posts.index');
    }

    public function render()
    {

          
       return view('livewire.admin.posts.create')
            ->layout('layouts.admin', ['title' => 'Create Post']);

            

        
    }
}
