<?php

namespace App\View\Components;

use Illuminate\View\Component;

class industryCarouselItem extends Component
{
    public $bgImageUrl;
    public $iconClass;
    public $title;
    public $subTitle;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($iconClass="", $bgImageUrl="", $title="", $subTitle="", $imageAlt="")
    {
        $this->bgImageUrl = $bgImageUrl;
        $this->iconClass = $iconClass;
        $this->imageAlt = $imageAlt;
        $this->title = $title;
        $this->subTitle = $subTitle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.industry-carousel-item');
    }
}
