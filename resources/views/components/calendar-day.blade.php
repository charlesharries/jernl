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
            if (count(explode(' ', $entry->title)) > 10) {
                return implode(' ', array_slice(explode(' ', $entry->title), 0, 10)) . '...';
            }

            if (strlen($entry->title)) {
                return $entry->title;
            }
            
            return implode(' ', array_slice(explode(' ', $entry->content), 0, 10)) . '...';
        }
    }
@endphp

<div class="Day @if($hasEntries) Day--withEntries @endif @if($isToday) Day--today @endif">
    <div class="Day__date flex">
        <p>
            <strong class="Day__date__number">{{ $day->format('d') }}</strong>
            <span class="hide-desktop">{{ $day->format('D') }}</span>
        </p>
        @if(!$hasEntries)
            <a href="/entries/create?date={{ $day->format('Y-m-d') }}" class="Day__newEntry">&plus;</a>
        @endif
    </div>

    @if($hasEntries)
        <ul class="Day__entries">
            @foreach($entries as $entry)
                <li class="Day__entry {{ ! $entry->is_encrypted ? "Day__entry--unencrypted": '' }}">
                    @if(!$entry->is_encrypted)
                        <x-app-icon use="unlock" />
                    @endif
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
