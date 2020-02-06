@extends('layouts.app')

@section('content')
<div>
    <div class="container">
        <div class="Home__wrapper">
            <div class="Home__heading">
                <h1>Jernl</h1>
            </div>
            
            <div class=Home__footer>
                <nav class="Home__nav">
                    <ul>
                        @guest
                            <li>
                                <a class="nav__link text-h3 font-strong" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li>
                                    <a class="nav__link text-h3 font-strong" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
        
                                    <button type="submit" class="nav__link text-h3">Logout</button>
                                </form>
                            </li>
                        @endguest
                    </ul>
                </nav>
                <h3>It's a journal. Click on a day, write your entry. Keep the streak going. Let's go. We're trying something</h3>
            </div>
        </div>
    </div>
</div>
@endsection