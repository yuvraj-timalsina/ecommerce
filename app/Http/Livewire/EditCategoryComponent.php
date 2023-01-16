<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class EditCategoryComponent extends Component
{
    use WithFileUploads;

    public $category_id;
    public $name;
    public $slug;
    public $image;
    public $is_popular;
    public $new_image;


    public function generateSlug(): void
    {
        $this->slug = str()->slug($this->name);
    }


    public function mount(Category $category): void
    {
        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->image = $category->image;
        $this->is_popular = $category->is_popular;
    }


    public function updateCategory(): void
    {

        $category = Category::find($this->category_id);

        $data_valid = $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'new_image' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
            'is_popular' => 'required',
        ]);
        if ($this->new_image) {
            if ($category->image !== null && Storage::disk('public')->exists($category->image)) {
                Storage::delete($category->image);
            }
            $data_valid['image'] = $this->new_image->store('categories');
        }

        $category->update($data_valid);
        flasher('Category Updated Successfully!');
    }


    public function render(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('livewire.edit-category-component', compact('categories'));
    }
}
