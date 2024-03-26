<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ScalableSolutionCard extends Component
{
    public $icon;
    public $title;
    public $content;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($icon, $title, $content)
    {
        $this->icon = $icon;
        $this->title = $title;
        $this->content = $content;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.scalable-solution-card');
    }
}
