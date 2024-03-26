<?php

namespace App\View\Components;

use Illuminate\View\Component;

class JobCard extends Component
{
    public $pillColor;
    public $pillTitle;
    public $pillColor1;
    public $pillTitle1;
    public $title;
    public $description;
    public $slug;
    public $vacancyId;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($pillColor, $pillTitle, $pillColor1, $pillTitle1, $title, $description, $slug, $vacancyId)
    {
        $this->pillColor = $pillColor;
        $this->pillTitle = $pillTitle;
        $this->pillColor1 = $pillColor1;
        $this->pillTitle1 = $pillTitle1;
        $this->title = $title;
        $this->description = $description;
        $this->slug = $slug;
        $this->vacancyId = $vacancyId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.job-card');
    }
}
