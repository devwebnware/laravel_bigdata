<?php

namespace App\View\Components;

use Illuminate\View\Component;

class HowWeHelpCard extends Component
{
    public $icon;
    public $title;
    public $content;
    public $listItem1;
    public $listItem2;
    public $listItem3;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($icon, $title, $content, $listItem1 = "", $listItem2 = "", $listItem3 = "")
    {
        $this->icon = $icon;
        $this->title = $title;
        $this->content = $content;
        $this->listItem1 = $listItem1;
        $this->listItem2 = $listItem2;
        $this->listItem3 = $listItem3;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.how-we-help-card');
    }
}
