@extends('layouts.app')

@section('page-slug', 'create-entry')

@section('content')
<div class="CreateEntry">
    <div class="container">
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
                        </div>
                    </div>

                    <div class="field field--content">
                        <label class="field__label" for="content">Content</label>

                        <div class="field__control">
                            <textarea name="content" id="content" class="field__input field__input--content" placeholder="What did you get up to today?"
                                rows="2" data-autoresize>{{ old('content') }}</textarea>
                        </div>
                    </div>
                    
                    <input type="hidden" name="date" value="{{ $day->format('Y-m-d') }}" />
					
					<div class="field">
						<button class="button">Save</button>
					</div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
