@extends('layouts.app')

@section('content')
<div class="Login">
    <div class="container">
        <div class="cover">
            <div class="cover-content stack">

                <h1 class="text-h3 border-top">{{ __('Login') }}</h1>
                <form method="POST" action="{{ route('login') }}" class="stack">
                    @csrf

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
                                required autocomplete="current-password">

                            @error('password')
                                <p class="field__help" role="alert">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <div class="field">
                        <input class="field__input field__input--checkbox" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>

                        <label class="field__label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>

                    <div class="field field--submitButtons stack">
                        <button type="submit" class="button">
                            {{ __('Login') }}
                        </button>

                        @if(Route::has('password.request'))
                            <a class="link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
