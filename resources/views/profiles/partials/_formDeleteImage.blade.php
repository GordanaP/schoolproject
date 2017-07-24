<form action="{{ route('profiles.destroy.file', $user->name) }}" method="POST">

    {{ csrf_field() }}
    {{ method_field('DELETE') }}

    <button type="submit" class="btn btn-link">
        Delete image
    </button>

</form>