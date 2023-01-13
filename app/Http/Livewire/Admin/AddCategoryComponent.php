<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;

class AddCategoryComponent extends Component
{
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


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function storeCategory()
    {
        Category::create($this->validate());
        session()->flash('success_message', 'New Category Created!');
        $this->reset();
    }


    public function render()
    {
        return view('livewire.admin.add-category-component');
    }
}
