<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{

    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $type;
    public $color;
    public $message;
    public function __construct($type,$inputmsg)
    {
        
        $this->message = $inputmsg;
        if($type == 'success'){
            $this->color = "bg-green-200";
        }elseif($type == 'danger'){
            $this->color = "bg-red-200";
        }elseif($type == 'warning'){
            $this->color = "bg-yellow-200";
        }
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
