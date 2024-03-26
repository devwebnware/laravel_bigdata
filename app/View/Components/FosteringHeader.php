<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FosteringHeader extends Component
{
    public $title;
    public $content;
    public $heading;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $content, $heading = "")
    {
        $this->title = $title;
        $this->content = $content;
        $this->heading = $heading;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.fostering-header');
    }
}
