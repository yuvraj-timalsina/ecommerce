<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Contracts\View\View;

class AddProductComponent extends Component
{
    use WithFileUploads;

    public $name;
    public $slug;
    public $short_description;
    public $description;
    public $regular_price;
    public $sale_price;
    public $sku;
    public $stock_status = 'in_stock';
    public $featured = 0;
    public $quantity;
    public $image;
    public $category_id;

    public function generateSlug(): void
    {
        $this->slug = str()->slug($this->name);
    }
    public function storeProduct(): void
    {
        $data_valid = $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'short_description' => 'nullable',
            'description' => 'nullable',
            'regular_price' => 'required',
            'sale_price' => 'nullable',
            'sku' => 'required',
            'quantity' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
            'category_id' => 'required',
        ]);

        $data_valid['image'] = $this->image->store('products', 'public');

        Product::create($data_valid);
        to_route('admin.products');
        session()->flash('success_message', 'New Product Added!');
    }


    public function render(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('livewire.admin.add-product-component', compact('categories'));
    }
}
