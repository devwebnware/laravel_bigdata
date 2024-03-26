<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ServicesCard extends Component
{
    public $title;
    public $content;
    public $icon;
    public $slug;
    public $class;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $content, $icon, $slug, $class="")
    {
        $this->title = $title;
        $this->content = $content;
        $this->icon = $icon;
        $this->slug = $slug;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.services-card');
    }
}
