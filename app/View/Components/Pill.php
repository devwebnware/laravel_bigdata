<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Pill extends Component
{
    public $id;
    public $color;
    public $title;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($color,$title,$id="")
    {
        $this->color = $color;
        $this->title = $title;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pill');
    }
}
