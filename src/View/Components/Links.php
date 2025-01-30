<?php

namespace Primecorecz\Links\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Primecorecz\Links\Models\Link;
use Primecorecz\Links\Models\Tag;

class Links extends Component
{
    public iterable $linkGroups;

    /**
     * Create a new component instance.
     */
    public function __construct(Tag|string $tag)
    {
        $this->linkGroups = Link::prepareViewData($tag);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('primecore-links-package::components.links');
    }
}
