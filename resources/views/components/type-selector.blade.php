<div class="TypeSelector">
    <form action="/user-preferences" method="POST">
        @method('PATCH')
        @csrf

        <input type="hidden" name="use_serif" value="1">
        <button type="submit" class="TypeSelector__button TypeSelector__button--serif">A</button>
    </form>

    <form action="/user-preferences" method="POST">
        @method('PATCH')
        @csrf

        <input type="hidden" name="use_serif" value="0">
        <button type="submit" class="TypeSelector__button TypeSelector__button--sans">A</button>
    </form>
</div>