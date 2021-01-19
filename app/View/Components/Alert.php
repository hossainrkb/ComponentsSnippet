<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $message;
    public $type;

    public function __construct($message,$type="danger")
    {
        $this->message = $message;
        $this->type = $type;
    }

    public function isSelected($option)
{
    return $option === $this->message;
}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
