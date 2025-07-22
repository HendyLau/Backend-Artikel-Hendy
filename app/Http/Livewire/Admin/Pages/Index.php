<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Page;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $confirmingPageDeletion = false;
    public $deleteId;

    protected $paginationTheme = 'tailwind';
    protected $listeners = ['confirmDelete'];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = decrypt($id);
        $this->confirmingPageDeletion = true;
    }

    public function deletePage()
    {
        Page::findOrFail($this->deleteId)->delete();
        session()->flash('success', __('Page deleted successfully.'));
        $this->confirmingPageDeletion = false;
    }

    public function render()
    {
        $locale = session('user_locale', 'en');

        $pages = Page::query()
            ->when($this->search, function ($query) use ($locale) {
                $query->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(title, '$.\"$locale\"')) LIKE ?", ['%' . $this->search . '%']);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.pages.index', compact('pages'))
            ->layout('components.layouts.admin', [
                'activeMenu' => 'pages',
            ]);
    }
}
