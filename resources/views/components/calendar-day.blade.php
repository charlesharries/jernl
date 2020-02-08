@php
/**
 * Display a single day on the calendar.
 * 
 * @param \DateTime $day
 */
@endphp

<div class="Day">
	<p class="Day__date">
		<span class="text-label">{{ $day->format('D') }}</span>
		<strong class="Day__date__number">{{ $day->format('d') }}</strong>
	</p>

	<p class="Day__link">
		<a href="/entries/create?date={{ $day->format('Y-m-d') }}">New entry</a>
	</p>
</div>