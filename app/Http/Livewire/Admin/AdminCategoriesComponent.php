<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;

class AdminCategoriesComponent extends Component
{
    use WithPagination;

    public $category_id;


    public function deleteCategory(): void
    {
        $category = Category::findOrFail($this->category_id);
        if (File::exists($category->image)) {
            unlink(public_path('/storage/' . $category->image));
        }

        $category->delete();
        session()->flash('success_message', 'Category Deleted!');
    }


    public function render(): View
    {
        $categories = Category::orderBy('name')->paginate(5);

        return view('livewire.admin.admin-categories-component', compact('categories'));
    }
}
