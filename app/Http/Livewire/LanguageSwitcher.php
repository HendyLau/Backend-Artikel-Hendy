<?php
namespace App\Http\Livewire;


use Livewire\Component;

class LanguageSwitcher extends Component
{
    public $locale;

    public function mount()
    {
        $this->locale = session('user_locale', config('app.locale'));
    }

   public function updatedLocale($value)
{
    session(['user_locale' => $value]);
    app()->setLocale($value);

    // Refresh full halaman untuk menerapkan bahasa
    return redirect(request()->header('Referer') ?? url('/'));
}


    public function render()
    {
        return view('livewire.language-switcher');
    }
}





