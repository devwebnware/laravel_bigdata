<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ConsultationSquareButton extends Component
{
    public $title;
    public $class;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = "Get Consultation", $class)
    {
        $this->title = $title;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.consultation-square-button');
    }
}
