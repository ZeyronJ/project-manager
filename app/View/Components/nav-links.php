<?php

namespace App\View\Components;

use Illuminate\View\Component;

class nav-links extends Component
{
    /**
     * The project id.
     *
     * @var int
     */
    public $project;
 
    /**
     * The dirname.
     *
     * @var string
     */
    public $dirname;    
    /**
     * Create a new component instance.
     * @param string $project
     * @param string $dirname
     * @return void
     */
    public function __construct($project,$dirname)
    {
        $this->project = $project;
        $this->dirname = $dirname;
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.nav-links');
    }
}
