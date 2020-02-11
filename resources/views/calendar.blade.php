@php
    $startDay = (int)$month->getStartDate()->format('N');
    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
@endphp

@extends('layouts.app')

@section('content')
<div class="Calendar">
    <div class="container">
        <div class="flex space-between">
            <h1 class="text-h3">Your Journal</h1>

            <log-out />
        </div>

        <h3 class="text-h1">{{ $month->getStartDate()->format('F') }}</h3>

        <div class="Calendar__days grid">
            @for($i = 0; $i < 7; $i++)
                <div class="Calendar__heading grid__item">
                    <h4>{{ $days[$i] }}</h4>
                </div>
            @endfor

            @for($i = 0; $i < $startDay - 1; $i++)
                <div class="grid__item"></div>
            @endfor

            @foreach($month as $day)
                <div class="grid__item">
                    <calendar-day :day="$day" />
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
