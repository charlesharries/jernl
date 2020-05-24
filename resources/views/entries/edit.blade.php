@extends('layouts.app')

@section('page-slug', 'create-entry')

@section('content')
<div class="CreateEntry">
    <div class="container">
        <div class="grid">
            <div class="CreateEntry__main grid__item stack stack-md">
                <p><a href="/calendar">
                        < Back to Calendar</a> </p> <div class="CreateEntry__heading">
                            <h1 class="text-h4">Edit entry</h1>
                            <h2>{{ $entry->date->format('d l Y') }}</h2>
            </div>

            <form action="/entries/{{ $entry->id }}" method="POST" class="CreateEntry__form stack">
				@csrf
				@method('PUT')

                <div class="field field-lg">
                    <label class="field__label" for="content">Title</label>

                    <div class="field__control">
                        <input name="title" id="title" type="text" value="{{ $entry->title }}" class="field__input" />
                        
                        @error('title')
                            <p class="field__help" role="alert">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <input id="input-for-trix" type="hidden" name="content" value="{{ $entry->content }}"/>

                <trix-editor input="input-for-trix" placeholder="What did you get up to today?"></trix-editor>

                <div class="field">
                    <button class="button">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
