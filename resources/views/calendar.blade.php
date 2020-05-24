@php
    $startDay = (int)$month->getStartDate()->format('N');
    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
@endphp

@extends('layouts.app')

@section('title', $month->getStartDate()->format('F \'y') )

@section('content')
<div class="Calendar">
    <div class="container stack">
        <div class="flex justify-between align-center">
            <h1 class="text-h3">Your Journal</h1>

            <log-out />
        </div>

        <h3 class="Calendar__title text-h1">{{ $month->getStartDate()->format('F \'y') }}</h3>

        <div class="Calendar__nav flex align-center">
            <a href="/calendar/{{ $lastMonth->format('Y-m') }}">
                &lsaquo; {{ $lastMonth->format('F') }}
            </a>
            <strong>
                <a class="button" href="/calendar">Today</a>
            </strong>
            <a href="/calendar/{{ $nextMonth->format('Y-m') }}">
                {{ $nextMonth->format('F') }} &rsaquo;
            </a>
        </div>

        <div class="Calendar__days grid">
            @for($i = 0; $i < 7; $i++)
                <div class="Calendar__heading grid__item hide-mobile">
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

        <h2 class="Calendar__yearTitle">{{ $month->getStartDate()->format('Y') }}</h2>

        <div class="Calendar__year grid">
            @for ($i = 0; $i < 12; $i++)
                <div class="grid__item">
                    <calendar-month 
                        :month="$i"
                        :year="$month->getStartDate()->format('Y')"
                        :allEntries="$allEntries"
                    />
                </div>
            @endfor
        </div>
    </div>
</div>
@endsection
