<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Counter extends Component
{
    public $count;
    public $class;
    public $title;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($count, $title,$class="")
    {
        $this->title = $title;
        $this->count = $count;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.counter');
    }
}
