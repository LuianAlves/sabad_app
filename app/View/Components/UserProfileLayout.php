<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class UserProfileLayout extends Component
{
    public function render(): View
    {
        return view('layouts.templates.user-profile-layout');
    }
}
