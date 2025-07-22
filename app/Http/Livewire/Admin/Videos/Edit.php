<?php

namespace App\Http\Livewire\Admin\Videos;

use App\Models\Video;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Edit extends Component
{
    use WithFileUploads;

    public $video;
    public $videoId;
    public $title, $slug, $short_description, $content, $image, $status, $published_at;
    public $categories = [];
    public $selectedCategories = [];
     public ?string $publishedAtForInput = null;

    public function mount($id)
    {
        $this->videoId = decrypt($id);

        $this->video = Video::with('categories')->findOrFail($this->videoId);

        $this->title = $this->video->title;
        $this->slug = $this->video->slug;
        $this->short_description = $this->video->short_description;
        $this->content = $this->video->content;
        $this->status = $this->video->status;

        $this->publishedAtForInput = $this->video->published_at
            ? $this->video->published_at->format('Y-m-d\TH:i')
            : null;

        $this->selectedCategories = $this->video->categories->pluck('id')->toArray();
        
          $this->url = $this->video->url ? $this->video->url->store('videos', 'public') : null;
    }

    public function updatedTitle()
    {
        $this->slug = Str::slug($this->title);
    }




    
    public function update()
    {
        $this->validate([
            'title' => 'required',
            'slug' => 'required|unique:videos,slug,' . $this->video->id,
            'content' => 'required',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        $this->video->update([
            'title' => $this->title,
            'slug' => $this->slug,
            'short_description' => $this->short_description,
            'content' => $this->content,
            'status' => $this->status,
            'published_at' =>  $this->publishedAtForInput ? Carbon::parse($this->publishedAtForInput) : null,
            'locale' => session('user_locale', 'en'),
            'url' => $this->url ? $this->url->store('videos', 'public') : $this->video->url,
        ]);

        $this->video->categories()->sync($this->selectedCategories);

        session()->flash('success', __('Video updated successfully.'));
        return redirect()->route('videos.index');
    }

   
    public function render()
{
    $this->categories = Category::all(); //
   return view('livewire.admin.videos.edit')
            ->layout('layouts.admin', ['title' => 'Edit Video']);
   
}

}
