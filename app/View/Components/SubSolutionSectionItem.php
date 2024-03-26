<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SubSolutionSectionItem extends Component
{
    public $color;
    public $title;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $color)
    {
        $this->title = $title;
        $this->color = $color;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sub-solution-section-item');
    }
}
