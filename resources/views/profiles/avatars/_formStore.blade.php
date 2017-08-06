<form action="{{ route('avatars.store', $user) }}" method="POST" enctype="multipart/form-data">

    {{ csrf_field() }}

    <div class="form-group">
        <input type="file" name="image" id="image">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-link text-uppercase" id="uploadFile">
            Upload
        </button>
    </div>

</form>
