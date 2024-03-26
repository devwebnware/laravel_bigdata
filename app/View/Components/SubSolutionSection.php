<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SubSolutionSection extends Component
{
    public $class;
    public $image;
    public $title;
    public $content;
    public $pillColor;
    public $pillTitle;
    public $imageAlt;
    public $imageTitle;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($class, $image, $title, $content, $pillColor = "", $pillTitle = "", $imageAlt = "", $imageTitle = "")
    {
        $this->class = $class;
        $this->image = $image;
        $this->title = $title;
        $this->content = $content;
        $this->pillColor = $pillColor;
        $this->pillTitle = $pillTitle;
        $this->imageAlt = $imageAlt;
        $this->imageTitle = $imageTitle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sub-solution-section');
    }
}
