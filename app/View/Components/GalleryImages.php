<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GalleryImages extends Component
{
    public $title;
    public $alt;
    public $image;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $alt, $image)
    {
        $this->title = $title;
        $this->alt = $alt;
        $this->image = $image;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.gallery-images');
    }
}
