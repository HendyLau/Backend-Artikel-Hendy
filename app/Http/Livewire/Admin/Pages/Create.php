<?php

namespace App\Http\Livewire\Admin\Pages;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Page;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class Create extends Component
{
    use WithFileUploads;

    public $title, $slug, $body;
   
    public $locale;

    public function mount()
{
    $this->locale = session('user_locale', 'en');
    $this->categories = Category::all();
}

    protected $rules = [
        'title' => 'required|min:3',
        'slug' => 'required|unique:posts,slug',
        
        'body' => 'required|string',
        
    ];

    public function updatedTitle()
    {
        $this->slug = Str::slug($this->title);
    }

    public function save()
    {
        $this->validate();

        $pages = Page::create([
            'title' => $this->title,
            'slug' => $this->slug,
          
            'body' => $this->body,
            
            'locale' => session('user_locale', 'en'),
            
        ]);

      

        session()->flash('success', __('Pages created successfully.'));
        return redirect()->route('pages.index');
    }

    public function render()
    {
        return view('livewire.admin.pages.create')
            ->layout('layouts.admin', ['title' => 'Create']);
    }
}
