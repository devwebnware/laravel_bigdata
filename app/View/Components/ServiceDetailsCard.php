<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ServiceDetailsCard extends Component
{
    public $title;
    public $content;
    public $icon;
    public $class;
    public $cardClass;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $content, $icon, $class="col-lg-4 col-md-6 col-12", $cardClass="blue-side-circle")
    {
        $this->title = $title;
        $this->content = $content;
        $this->icon = $icon;
        $this->class = $class;
        $this->cardClass = $cardClass;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.service-details-card');
    }
}
