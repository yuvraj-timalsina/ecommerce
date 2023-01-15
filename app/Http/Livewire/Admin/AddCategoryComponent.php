<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Contracts\View\View;

class AddCategoryComponent extends Component
{
    public $name;
    public $slug;

    public function generateSlug(): void
    {
        $this->slug = str()->slug($this->name);
    }

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }


    public function storeCategory(): void
    {
        $data_valid = $this->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);

        Category::create($data_valid);
        to_route('admin.categories');
        session()->flash('success_message', 'New Category Created!');
    }


    public function render(): View
    {
        return view('livewire.admin.add-category-component');
    }
}
