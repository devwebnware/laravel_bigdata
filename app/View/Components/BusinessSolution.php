<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BusinessSolution extends Component
{
    public $title;
    public $content;
    public $link;
    public $class;
    public $image;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $content, $link = "", $class, $image)
    {
        $this->title = $title;
        $this->content = $content;
        $this->link = $link;
        $this->class = $class;
        $this->image = $image;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.business-solution');
    }
}
