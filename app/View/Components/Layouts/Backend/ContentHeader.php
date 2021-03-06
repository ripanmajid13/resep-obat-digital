<?php

namespace App\View\Components\Layouts\Backend;

use Illuminate\View\Component;

class ContentHeader extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.layouts.backend.content-header', [
            'titlePage' => ucwords(str_replace('-', ' ', request()->segment(1)))
        ]);
    }
}
