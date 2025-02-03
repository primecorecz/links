
@if (! empty($linkGroups))
    <div {{ $attributes->class('mx-8 mt-8 xl:mx-16 xl:mt-16') }}>
        <h2 class="mb-4 text-sm text-gray-400 font-bold">Užitečné odkazy:</h2>
        <div class="flex gap-8 flex-wrap lg:flex-nowrap lg:justify-between">
            @foreach ($linkGroups as $groupKey => $group)
                <ul>
                    @foreach ($group as $link)
                        <li><a href="{{ $link->urlOrLinkableUrl }}" @class([
                            'text-xs text-gray-500 underline hover:no-underline hover:text-black',
                            'font-bold' => $groupKey === 'post' && $link->linkable,
                        ])>{{ $link->titleOrLinkableTitle }}</a></li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    </div>
@endif
