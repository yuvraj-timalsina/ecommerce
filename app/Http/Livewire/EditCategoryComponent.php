<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Contracts\View\View;

class EditCategoryComponent extends Component
{
    public $category_id;
    public $name;
    public $slug;

    public function generateSlug(): void
    {
        $this->slug = str()->slug($this->name);
    }


    public function mount(Category $category): void
    {
        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
    }


    public function updateCategory(): void
    {

        $category = Category::find($this->category_id);

         $data_valid = $this->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);
        $category->update($data_valid);
        session()->flash('success_message', 'Category Updated!');
    }


    public function render(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('livewire.edit-category-component', compact('categories'));
    }
}
