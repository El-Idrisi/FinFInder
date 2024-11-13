<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class verifCard extends Component
{
    /**
     * Create a new component instance.
     */
// app/View/Components/VerifCard.php
    public $idMap;
    public $creator;
    public $latitude;
    public $longitude;
    public $jenisIkan;
    public $date;

    public function __construct($idMap, $creator, $latitude, $longitude, $jenisIkan, $date)
    {
        $this->idMap = $idMap;
        $this->creator = $creator;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->jenisIkan = $jenisIkan;
        $this->date = $date;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.verif-card');
    }
}
