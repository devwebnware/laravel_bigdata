<?php

namespace App\View\Components;

use Illuminate\View\Component;

class serviceAccordionItem extends Component
{
    public $title;
    public $id;
    public $description;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $description, $id)
    {
        $this->title = $title;
        $this->description = $description;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.service-accordion-item');
    }
}
