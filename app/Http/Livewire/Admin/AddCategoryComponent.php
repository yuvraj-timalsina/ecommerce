<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Contracts\View\View;

class AddCategoryComponent extends Component
{
    use WithFileUploads;

    public $name;
    public $slug;
    public $image;
    public $is_popular = 0;


    public function generateSlug(): void
    {
        $this->slug = str()->slug($this->name);
    }

    public function storeCategory(): void
    {
        $data_valid = $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
        ]);

        $data_valid['image'] = $this->image->store('categories');

        Category::create($data_valid);
        to_route('admin.categories');
        session()->flash('success_message', 'New Category Created!');
    }


    public function render(): View
    {
        return view('livewire.admin.add-category-component');
    }
}
