<?php

namespace App\Http\Livewire\Admin\Videos;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Video;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class Create extends Component
{
    use WithFileUploads;

    public $title, $slug, $content, $short_description, $videoFile, $status = 'draft', $published_at;
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
       'videoFile' => 'required|file|mimetypes:video/mp4,video/x-msvideo,video/quicktime|max:10240000',
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
        $video = Video::create([
            'title' => $this->title,
            'slug' => $this->slug,
            'short_description' => $this->short_description,
            'content' => $this->content,
            'status' => $this->status,
            'published_at' => $this->published_at ?? now(),
           'url' => $this->videoFile ? $this->videoFile->store('videos', 'public') : null,
            'locale' => session('user_locale', 'en'),
            
        ]);

       $video->categories()->sync($this->selectedCategories);

        session()->flash('success', __('Video created successfully.'));
        return redirect()->route('videos.index');
    }

    public function render()
    {

          
       return view('livewire.admin.videos.create')
            ->layout('layouts.admin', ['title' => 'Create Video']);

            

        
    }
}
