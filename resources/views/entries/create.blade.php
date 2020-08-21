@extends('layouts.app')

@section('page-slug', 'create-entry')

@section('content')
<div class="CreateEntry">
    <div class="container stack stack-md">
        <the-header>
            Create entry
        </the-header>
        <div class="grid">
            <div class="CreateEntry__main grid__item stack stack-md">
				<p><a href="/calendar">< Back to Calendar</a></p>
                <div class="CreateEntry__heading">
                    <h1 class="text-h4">Create entry</h1>
                    <h2>{{ $day->format('d l Y') }}</h2>
                </div>

				<form action="/entries" method="POST" class="stack" class="CreateEntry__form">
					@csrf
					
                    <div class="field field-lg">
                        <label class="field__label" for="content">Title</label>

                        <div class="field__control">
                            <input name="title" id="title" type="text" value="{{ old('title') }}"
                                class="field__input" />
                                                    
                            @error('title')
                                <p class="field__help" role="alert">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <input id="input-for-trix" type="hidden" name="content" value="{{ old('content') }}"/>

                    <trix-editor input="input-for-trix" placeholder="What did you get up to today?"></trix-editor>
                    
                    <input type="hidden" name="date" value="{{ $day->format('Y-m-d') }}" />
					
					<div class="field">
						<button class="button button--grey">Save</button>
					</div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
