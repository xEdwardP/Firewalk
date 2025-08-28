<?php

namespace App\View\Components\Pages;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PageHeader extends Component
{
    public string $title;
    public array $breadcrumbs;
    public string $icon;
    /**
     * Create a new component instance.
     */
    public function __construct(string $title, array $breadcrumbs = [], string $icon)
    {
        $this->title = $title;
        $this->breadcrumbs = $breadcrumbs;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pages.page-header');
    }
}
