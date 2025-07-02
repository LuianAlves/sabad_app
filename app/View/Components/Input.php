<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public $col;
    public $set;
    public $type;
    public $title;
    public $id;
    public $name;
    public $placeholder;
    public $value;
    public $disabled;

    public function __construct($col, $type, $title, $name, $id, $set = null, $placeholder = null, $value = null, bool $disabled = false)
    {
        $this->col = $col;
        $this->type = $type;
        $this->title = $title;
        $this->name = $name;
        $this->id = $id;
        $this->set = $set;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->disabled = $disabled;
    }

    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
