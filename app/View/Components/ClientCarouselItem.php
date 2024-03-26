<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ClientCarouselItem extends Component
{
    public $image;
    public $style;
    public $altText;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($image,$style="",$altText="")
    {
        $this->image = $image;
        $this->style = $style;
        $this->altText = $altText;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.client-carousel-item');
    }
}
