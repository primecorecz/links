<?php

namespace Primecorecz\Links\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\View\Component;
use Primecorecz\Links\Models\Link;
use Primecorecz\Links\Models\Tag;
use Throwable;

class Links extends Component
{
    public iterable $linkGroups = [];

    /**
     * Create a new component instance.
     */
    public function __construct(Tag|string $tag)
    {
        try {
            $this->linkGroups = Link::prepareViewData($tag);
        } catch (Throwable $th) {
            Log::error($th);
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        /** @var view-string */
        $path = 'primecore-links-package::components.links';

        return view($path);
    }
}
