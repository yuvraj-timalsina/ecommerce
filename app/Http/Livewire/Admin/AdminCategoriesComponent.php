<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;

class AdminCategoriesComponent extends Component
{
    use WithPagination;
    public function render():View
    {
        $categories = Category::orderBy('name')->paginate(5);
        return view('livewire.admin.admin-categories-component', compact('categories'));
    }
}
