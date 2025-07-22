<?php

namespace App\Http\Livewire\Admin\Videos;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;


class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $confirmingPostDeletion = false;
    public $deleteId;
    protected $queryString = ['search'];
    protected $paginationTheme = 'tailwind';
    protected $listeners = ['confirmDelete'];
    

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = decrypt($id);
        $this->confirmingPostDeletion = true;
    }

    public function deleteVideo()
    {
        Video::findOrFail($this->deleteId)->delete();
        session()->flash('success', __('Video deleted successfully.'));
        $this->confirmingPostDeletion = false;
    }

    
    public function render()
    {
        $locale = session('user_locale', 'en');

        $videos = Video::with('categories')
            ->when($this->search, function ($query) use ($locale) {
                $query->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(title, '$.\"$locale\"')) LIKE ?", ['%' . $this->search . '%']);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.videos.index', [
        'videos' => $videos,
    ])->layout('components.layouts.admin', [
        'activeMenu' => 'videos', // <-- ini penting
    ]);
    }
     
}
