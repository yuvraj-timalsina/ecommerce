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
        Category::find($this->category_id)?->delete();
        session()->flash('success_message', 'Category Deleted!');
    }

    public function render(): View
    {
        $categories = Category::orderBy('name')->paginate(5);

        return view('livewire.admin.admin-categories-component', compact('categories'));
    }
}
