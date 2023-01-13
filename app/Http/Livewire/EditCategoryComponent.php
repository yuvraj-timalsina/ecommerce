<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

class EditCategoryComponent extends Component
{
    public $categoryId;
    public $name;
    public $slug;

    protected $rules = [
        'name' => 'required',
        'slug' => 'required',
    ];


    public function generateSlug()
    {
        $this->slug = str()->slug($this->name);
    }


    public function mount(Category $category)
    {
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
    }


    public function updateCategory()
    {
        $category = Category::find($this->categoryId);
        $category->update($this->validate());
        session()->flash('success_message', 'Category Updated!');
    }


    public function render()
    {
        return view('livewire.edit-category-component');
    }
}
