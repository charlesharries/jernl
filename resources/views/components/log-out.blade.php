<form action="{{ route('logout') }}" method="POST">
	@csrf

	<button type="submit" class="Nav__link button {{ $class ?? '' }}">Logout</button>
</form>
