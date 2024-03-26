<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TestimonialCarouselItem extends Component
{
    public $content;
    public $authorImage;
    public $authorName;
    public $authorDesignation;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($content, $authorImage, $authorName, $authorDesignation)
    {
        $this->content = $content;
        $this->authorImage = $authorImage;
        $this->authorName = $authorName;
        $this->authorDesignation = $authorDesignation;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.testimonial-carousel-item');
    }
}
