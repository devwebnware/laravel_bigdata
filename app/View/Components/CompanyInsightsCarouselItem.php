<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CompanyInsightsCarouselItem extends Component
{
    public $image;
    public $title;
    public $subtitle;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($image, $title, $subtitle)
    {
        $this->image = $image;
        $this->title = $title;
        $this->subtitle = $subtitle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.company-insights-carousel-item');
    }
}
