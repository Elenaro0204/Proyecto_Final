<?php

namespace App\View\Components;

use Illuminate\View\Component;

class WelcomeSection extends Component
{
    public $title;
    public $subtitle;
    public $bgImage; // <-- nueva propiedad para la imagen de fondo

    /**
     * Create a new component instance.
     *
     * @param string $title
     * @param string $subtitle
     * @param string|null $bgImage
     */
    public function __construct($title, $subtitle, $bgImage = null)
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->bgImage = $bgImage;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.welcome-section');
    }
}
