<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Accordion extends Component
{
    /**
     * Create a new component instance.
     */
    public string $id;
    public string $title;
    public string $description;
    public string $shortDescription;
    public function __construct(string $id, string $title, string $description, $shortDescription)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->shortDescription = $shortDescription;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.accordion');
    }
}
