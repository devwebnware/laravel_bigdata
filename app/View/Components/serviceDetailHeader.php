<?php

namespace App\View\Components;

use Illuminate\View\Component;

class serviceDetailHeader extends Component
{
    public $pillTitle;
    public $pillColor;
    public $title;
    public $description;
    public $image;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($pillColor,$pillTitle,$title,$description,$image)
    {
        $this->pillColor = $pillColor;
        $this->pillTitle = $pillTitle;
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.service-detail-header');
    }
}
