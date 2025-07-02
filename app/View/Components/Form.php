<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public $route;
    public $id;

    public function __construct($route, $id = null)
    {
        $this->route = $route;
        $this->id = $id;    
    }

    public function render(): View|Closure|string
    {
        return view('components.form');
    }
}
