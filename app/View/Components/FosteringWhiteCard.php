<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FosteringWhiteCard extends Component
{
    public $title;
    public $content;
    public $icon;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $content, $icon)
    {
        $this->title = $title;
        $this->icon = $icon;
        $this->content = $content;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.fostering-white-card');
    }
}
