<?php

namespace App\Http\Livewire\Admin\Categories;


use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;

class Create extends Component
{
      public $name;
     public $slug;
     
    

    protected $rules = [
        'name' => 'required|string|max:255|unique:categories,name',
          'slug' => 'required|unique:categories,slug',
    ];

     public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
        ]);

        Category::create([
            'name' => $this->name,
            'slug' => $this->slug,
            'locale' => session('user_locale', 'en'),
        ]);

        session()->flash('success', __('Category created successfully.'));

        return redirect()->route('categories.index');
    }

    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    
    public function render()
    {
         return view('livewire.admin.categories.create')
            ->layout('layouts.admin', ['title' => 'Create Categories']);
        
    }

  

    
}

