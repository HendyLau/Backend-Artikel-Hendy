<?php

namespace App\Http\Livewire\Admin\Pages;

use Livewire\Component;
use App\Models\Page;
use Illuminate\Support\Str;

class Edit extends Component
{
    public $page;
    public $title, $slug, $body, $status;

    public function mount($id)
    {
        $this->page = Page::findOrFail(decrypt($id));
        $this->title = $this->page->title;
        $this->slug = $this->page->slug;
        $this->body = $this->page->body;
        $this->status = $this->page->status;
    }

    public function updatedTitle()
    {
        $this->slug = Str::slug($this->title);
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|min:3',
            'slug' => 'required|unique:pages,slug,' . $this->page->id,
            'body' => 'required',
            'status' => 'required|in:draft,published',
        ]);

        $this->page->update([
            'title' => $this->title,
            'slug' => $this->slug,
            'body' => $this->body,
            'status' => $this->status,
        ]);

        session()->flash('success', __('Page updated successfully.'));
        return redirect()->route('pages.index');
    }

    public function render()
    {
        
        return view('livewire.admin.pages.edit')
            ->layout('components.layouts.admin', ['activeMenu' => 'pages']);
    }
}
