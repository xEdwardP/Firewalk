<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteButton extends Component
{
    public $action;
    public $itemId;
    public $label;

    /**
     * Create a new component instance.
     */
    public function __construct($action, $itemId, $label = 'Eliminar')
    {
        $this->action = $action;
        $this->itemId = $itemId;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.delete-button');
    }
}
