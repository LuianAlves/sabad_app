<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardHeader extends Component
{
    public $title;
    public $count;
    public $action;

    public function __construct($title, $action, $count = null)    
    {
        $this->title = $title;
        $this->count = $count;
        $this->action = $action;
    }
    
    public function render(): View|Closure|string
    {
        return view('components.card-header');
    }
}
