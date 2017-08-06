<form action="{{ route('avatars.destroy', $user->name) }}" method="POST">

    {{ csrf_field() }}
    {{ method_field('DELETE') }}

    <button type="submit" class="btn btn-link text-uppercase">
        Remove
    </button>

</form>