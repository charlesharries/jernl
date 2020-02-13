@php
    /**
    * Display a single day on the calendar.
    *
    * @param \DateTime $day
    */

    $entries = auth()->user()->entriesOn($day);
    $hasEntries = $entries->isNotEmpty();

    if (!function_exists('title')) {
        function title($entry) {
            if (strlen($entry->title)) {
                return $entry->title;
            }
            
            return implode(' ', array_slice(explode(' ', $entry->content), 0, 10)) . '...';
        }
    }
@endphp

<div class="Day @if($hasEntries) Day--withEntries @endif">
    <p class="Day__date">
        <strong class="Day__date__number">{{ $day->format('d') }}</strong>
    </p>

    @if(!$hasEntries)
        <p class="Day__link">
            <a href="/entries/create?date={{ $day->format('Y-m-d') }}">New entry</a>
        </p>
    @endif

    @if($hasEntries)
        <ul class="Day__entries">
            @foreach($entries as $entry)
                <li class="Day__entry">
                    <p>
                        <strong>
                            <a href="/entries/{{ $entry->id }}/edit">{{ title($entry) }}</a>
                        </strong>
                    </p>
                </li>
            @endforeach
        </ul>
    @endif
</div>
