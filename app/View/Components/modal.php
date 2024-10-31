<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class modal extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $idModal;
    public $idForm;
    public function __construct($title, $idModal, $idForm)
    {
        $this->title = $title;
        $this->idModal = $idModal;
        $this->idForm = $idForm;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal');
    }
}
