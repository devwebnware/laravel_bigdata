<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FosteringTechnologyCard extends Component
{
    public $image;
    public $title;
    public $subtitle;
    public $route;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($image, $title, $subtitle,$route)
    {
        $this->image = $image;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.fostering-technology-card');
    }
}
