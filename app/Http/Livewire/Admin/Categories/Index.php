<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $confirmingCategoryDeletion = false;

    protected $paginationTheme = 'tailwind';
    protected $listeners = ['confirmDelete'];


    public function updatedSearch()
    {
        $this->resetPage(); // agar pagination balik ke page 1
    }

    public function render()
{
    $locale = session('user_locale', 'en');

    $categories = Category::query()
        ->when($this->search, function ($query) use ($locale) {
            $query->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(name, '$.\"$locale\"')) LIKE ?", ['%' . $this->search . '%']);
        })
        ->latest()
        ->paginate(10);

    return view('livewire.admin.categories.index', [
        'categories' => $categories,
    ])->layout('components.layouts.admin', [
        'activeMenu' => 'categories', // Sidebar fokus di Categories
    ]);
}


     

     public function confirmDelete($id)
    {
        $this->deleteId = decrypt($id);
        $this->confirmingCategoryDeletion = true;
    }

     public function deleteCategory()
    {
        Category::findOrFail($this->deleteId)->delete();
        $this->confirmingCategoryDeletion = false;
        session()->flash('success', __('Category deleted successfully.'));
    }
}
