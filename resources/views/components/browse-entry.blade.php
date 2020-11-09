@props(['entry'])

<article class="BrowseEntry">
    <div class="switcher switcher--offset">
        <div class="stack stack--sm">
            <p>
                {{ $entry->date->format('j F Y') }}<br>
                {{ $entry->date->format('l') }}
            </p>
            <h2>{{ $entry->title }}</h2>
        </div>

        <div class="BrowseEntry__content">
            {!! $entry->content !!}
        </div>
    </div>
</article>
