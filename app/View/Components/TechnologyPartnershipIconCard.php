<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TechnologyPartnershipIconCard extends Component
{
    public $icon;
    public $title;
    public $href;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($icon, $title, $href = "javascript:void()")
    {
        $this->icon = $icon;
        $this->title = $title;
        $this->href = $href;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.technology-partnership-icon-card');
    }
}
