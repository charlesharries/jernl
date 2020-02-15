@php
    /**
    * Display a single day on the calendar.
    *
    * @param \DateTime $day
    */

    $entries = auth()->user()->entriesOn($day);
    $hasEntries = $entries->isNotEmpty();
    $isToday = $day->format('Y-m-d') === (new \DateTime())->format('Y-m-d');

    if (!function_exists('title')) {
        function title($entry) {
            if (strlen($entry->title)) {
                return $entry->title;
            }
            
            return implode(' ', array_slice(explode(' ', $entry->content), 0, 10)) . '...';
        }
    }
@endphp

<div class="Day @if($hasEntries) Day--withEntries @endif @if($isToday) Day--today @endif">
    <p class="Day__date flex justify-between align-center">
        <span>
            <strong class="Day__date__number">{{ $day->format('d') }}</strong>
            <span class="hide-desktop">{{ $day->format('D') }}</span>
        </span>
        <button class="Day__newEntry">&plus;</button>
    </p>

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
