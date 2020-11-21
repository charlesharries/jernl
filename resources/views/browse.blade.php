@extends('layouts.app')

@section('content')
<div class="Browse">
    <div class="container stack">
        <x-the-header>
            Browse
        </x-the-header>

        <div class="stack stack--lg">
            @foreach($entries as $entry)
                <x-browse-entry :entry="$entry" />
            @endforeach
        </div>
    </div>
</div>
@endsection
