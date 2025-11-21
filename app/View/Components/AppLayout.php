<?php

namespace App\View\Components;

use App\Models\Testimonial;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $testimonial = Testimonial::all();
        return view('layouts.app', compact('testimonial'));
    }
}
