<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SolutionBlueCard extends Component
{
    public $icon;
    public $title;
    public $content;
    public $slug;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($icon="", $title, $content,$slug)
    {
        $this->icon = $icon;
        $this->title = $title;
        $this->content = $content;
        $this->slug = $slug;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.solution-blue-card');
    }
}
