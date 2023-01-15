<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\HomeSlider;
use Livewire\WithFileUploads;
use Illuminate\Contracts\View\View;

class AddSlideComponent extends Component
{
    public $image;
    public $top_title;
    public $title;
    public $sub_title;
    public $offer;
    public $link;
    public $status = 0;

    use WithFileUploads;

    public function storeSlide(): void
    {
        $data_valid = $this->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
            'top_title' => 'required',
            'title' => 'required',
            'sub_title' => 'required',
            'offer' => 'required',
            'link' => 'required|url',
            'status' => 'required',
        ]);

        $data_valid['image'] = $this->image->store('slides');

        HomeSlider::create($data_valid);
        to_route('admin.slider');
        session()->flash('success_message', 'New Slide Added!');
    }


    public function render(): View
    {
        return view('livewire.admin.add-slide-component');
    }
}
