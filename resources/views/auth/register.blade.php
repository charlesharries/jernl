@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="Login">
    <div class="container">
        <div class="cover">
            <div class="cover-content stack">
                <h1 class="text-h3 border-top">{{ __('Register') }}</h1>

                <form class="stack" method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="field">
                        <label for="email" class="field__label">{{ __('Name') }}</label>

                        <div class="field__control">
                            <input id="name" type="text"
                                class="field__input @error('name') field__input--invalid @enderror" name="name"
                                value="{{ old('name') }}" required autocomplete="name" autofocus />

                            @error('name')
                                <p class="field__help" role="alert">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div class="field">
                        <label for="email" class="field__label">{{ __('E-Mail Address') }}</label>

                        <div class="field__control">
                            <input id="email" type="email"
                                class="field__input @error('email') field__input--invalid @enderror" name=" email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus />

                            @error('email')
                                <p class="field__help" role="alert">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div class="field">
                        <label for="password" class="field__label">{{ __('Password') }}</label>

                        <div class="field__control">
                            <input id="password" type="password"
                                class="field__input @error('password') field__input--invalid @enderror" name="password"
                                required autocomplete="new-password">

                            @error('password')
                                <p class="field__help" role="alert">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div class="field">
                        <label for="password-confirm" class="field__label">{{ __('Confirm password') }}</label>

                        <div class="field__control">
                            <input id="password_confirmation" type="password"
                                class="field__input @error('password_confirmation') field__input--invalid @enderror" name="password_confirmation"
                                required autocomplete="new-password">

                            @error('password-confirmation')
                                <p class="field__help" role="alert">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="button">
                            {{ __('Login') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
