<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CaseStudiesCard extends Component
{
    public $image;
    public $title;
    public $pillcolor;
    public $pilltitle;
    public $content;
    public $pagelink;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($image, $title, $pillcolor, $pilltitle, $content, $pagelink="#")
    {
        $this->image = $image;
        $this->title = $title;
        $this->pillcolor = $pillcolor;
        $this->pilltitle = $pilltitle;
        $this->content = $content;
        $this->pagelink = $pagelink;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.case-studies-card');
    }
}
