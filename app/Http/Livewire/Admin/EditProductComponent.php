<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Contracts\View\View;

class EditProductComponent extends Component
{
    use WithFileUploads;

    public $product_id;
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
    public $new_image;


    public function generateSlug(): void
    {
        $this->slug = str()->slug($this->name);
    }


    public function mount(Product $product): void
    {
        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->short_description = $product->short_description;
        $this->description = $product->description;
        $this->regular_price = $product->regular_price;
        $this->sale_price = $product->sale_price;
        $this->sku = $product->sku;
        $this->stock_status = $product->stock_status;
        $this->featured = $product->featured;
        $this->quantity = $product->quantity;
        $this->image = $product->image;
        $this->category_id = $product->category_id;
    }


    public function updateProduct(): void
    {
        $product = Product::find($this->product_id);
        $data_valid = $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'short_description' => 'nullable',
            'description' => 'nullable',
            'regular_price' => 'required',
            'sale_price' => 'nullable',
            'sku' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'required',
            'new_image' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
            'category_id' => 'required',
        ]);
        if ($this->new_image) {
//            unlink(public_path('/storage/' . $product->image));
            $data_valid['image'] = $this->new_image->store('products');
        }
        $product->update($data_valid);
        session()->flash('success_message', 'Product Updated!');
    }


    public function render(): View
    {
        $categories = Category::orderBy('name')->get();
        return view('livewire.admin.edit-product-component', compact('categories'));
    }
}
