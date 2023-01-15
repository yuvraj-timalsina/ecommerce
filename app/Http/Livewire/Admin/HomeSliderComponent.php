<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\HomeSlider;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;

class HomeSliderComponent extends Component
{

    use WithPagination;

    public $slide_id;


    public function deleteSlide(): void
    {
        $slide = HomeSlider::findOrFail($this->slide_id);
        unlink(public_path('/storage/' . $slide->image));
        $slide->delete();

        session()->flash('success_message', 'Slide Deleted!');
    }


    public function render(): View
    {
        $slides = HomeSlider::orderByDesc('created_at')->get();

        return view('livewire.admin.home-slider-component', compact('slides'));
    }
}
