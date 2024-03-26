<?php

namespace App\View\Components;

use Illuminate\View\Component;

class IndustriesAvailableSolutionCard extends Component
{
    public $icon;
    public $title;
    public $content;
    public $href;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($icon, $title, $content, $href = "")
    {
        $this->icon = $icon;
        $this->title = $title;
        $this->content = $content;
        $this->href = $href;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.industries-available-solution-card');
    }
}
