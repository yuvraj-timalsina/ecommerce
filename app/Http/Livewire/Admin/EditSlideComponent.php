<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\HomeSlider;
use Livewire\WithFileUploads;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class EditSlideComponent extends Component
{
    use WithFileUploads;

    public $slide_id;
    public $image;
    public $new_image;
    public $top_title;
    public $title;
    public $sub_title;
    public $offer;
    public $link;
    public $status;


    public function mount(HomeSlider $slider): void
    {
        $slide = HomeSlider::findOrFail($slider->id);
        $this->slide_id = $slide->id;
        $this->image = $slide->image;
        $this->top_title = $slide->top_title;
        $this->title = $slide->title;
        $this->sub_title = $slide->sub_title;
        $this->offer = $slide->offer;
        $this->link = $slide->link;
        $this->status = $slide->status;
    }


    public function updateSlide(): void
    {
        $slide = HomeSlider::findOrFail($this->slide_id);
        $data_valid = $this->validate([
            'new_image' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
            'top_title' => 'required',
            'title' => 'required',
            'sub_title' => 'required',
            'offer' => 'required',
            'link' => 'required|url',
            'status' => 'required',
        ]);
        if ($this->new_image) {
            if ($slide->image !== null && Storage::disk('public')->exists($slide->image)) {
                Storage::delete($slide->image);
            }
            $data_valid['image'] = $this->new_image->store('slides');
        }
        $slide->update($data_valid);
        flasher('Slide Updated Successfully!');
    }


    public function render(): View
    {
        return view('livewire.admin.edit-slide-component');
    }
}
