<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Carrusel extends Component
{
    public $title;
    public $subtitle;
    public $cards;

    public function __construct($title = '', $subtitle = '', $cards = [])
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->cards = $cards;
    }

    public function render()
    {
        return view('components.carrusel');
    }
}
