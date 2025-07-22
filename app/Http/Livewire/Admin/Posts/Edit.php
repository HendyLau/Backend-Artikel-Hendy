<?php

namespace App\Http\Livewire\Admin\Posts;

use App\Models\Post;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Edit extends Component
{
    use WithFileUploads;

    public $post;
    public $postId;
    public $title, $slug, $short_description, $content, $image, $status, $published_at;
    public $categories = [];
    public $selectedCategories = [];
     public ?string $publishedAtForInput = null;

    public function mount($id)
    {
        $this->postId = decrypt($id);

        $this->post = Post::with('categories')->findOrFail($this->postId);

        $this->title = $this->post->title;
        $this->slug = $this->post->slug;
        $this->short_description = $this->post->short_description;
        $this->content = $this->post->content;
        $this->status = $this->post->status;

        $this->publishedAtForInput = $this->post->published_at
            ? $this->post->published_at->format('Y-m-d\TH:i')
            : null;

        $this->selectedCategories = $this->post->categories->pluck('id')->toArray();
        
       
    }

    public function updatedTitle()
    {
        $this->slug = Str::slug($this->title);
    }




    
    public function update()
    {
        $this->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts,slug,' . $this->post->id,
            'content' => 'required',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        $this->post->update([
            'title' => $this->title,
            'slug' => $this->slug,
            'short_description' => $this->short_description,
            'content' => $this->content,
            'status' => $this->status,
            'published_at' =>  $this->publishedAtForInput ? Carbon::parse($this->publishedAtForInput) : null,
            'locale' => session('user_locale', 'en'),
            'image' => $this->image ? $this->image->store('posts', 'public') : $this->post->image,
        ]);

        $this->post->categories()->sync($this->selectedCategories);

        session()->flash('success', __('Post updated successfully.'));
        return redirect()->route('posts.index');
    }

   
    public function render()
{
    $this->categories = Category::all(); //
   return view('livewire.admin.posts.edit')
            ->layout('layouts.admin', ['title' => 'Edit Post']);
   
}

}
