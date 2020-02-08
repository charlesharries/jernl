@extends('layouts.app')

@section('content')
<div class="Calendar">
    <div class="container">
        <h1 class="text-h3">Your Journal</h1>

        <h3 class="text-h1">{{ $month->getStartDate()->format('F') }}</h3>

        <div class="Calendar__days stack">
            @foreach($month as $day)
                <calendar-day :day="$day" />
            @endforeach
        </div>
    </div>
</div>
@endsection
