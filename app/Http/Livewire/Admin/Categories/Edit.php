<?php

namespace App\Http\Livewire\Admin\Categories;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;

class Edit extends Component
{
    public $categoryId;
    public $name;
    public $slug;

    public function mount($id)
    {
        $this->categoryId = decrypt($id); // atau langsung pakai $id jika tidak dienkripsi
        $category = Category::findOrFail($this->categoryId);
        $this->name = $category->name;
        $this->slug = $category->slug;
    }

    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $this->categoryId,
        ]);

        $category = Category::findOrFail($this->categoryId);
        $category->update([
            'name' => $this->name,
            'slug' => $this->slug,
             'locale' => session('user_locale', 'en'),
        ]);

        session()->flash('success', __('Category updated successfully.'));
        return redirect()->route('categories.index');
    }

    public function render()
    {
     
       
           return view('livewire.admin.categories.edit')
            ->layout('layouts.admin', ['title' => 'Edit Categories']);
          
    }
}

