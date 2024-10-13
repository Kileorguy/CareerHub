<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class jobs_card extends Component
{
    public $position;
    public $location;
    public $company;
    public $summary;
    public $logo;

    public function __construct($position, $location, $company, $summary, $logo)
    {
        $this->position = $position;
        $this->location = $location;
        $this->company = $company;
        $this->summary = $summary;
        $this->logo = $logo;
    }

    public function render(): View|Closure|string
    {
        return view('components.jobs_card');
    }
}
