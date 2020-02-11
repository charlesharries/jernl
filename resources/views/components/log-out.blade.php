<form action="{{ route('logout') }}" method="POST">
	@csrf

	<button type="submit" class="nav__link {{ $class ?? '' }}">Logout</button>
</form>