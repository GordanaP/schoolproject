<form action="{{ route('profiles.update', $user) }}" method="POST" enctype="multipart/form-data"
    data-parsley-validate=""
    data-parsley-trigger="keyup"
    data-parsley-validation-threshold="1"
>

    {{ csrf_field() }}
    {{ method_field('PATCH') }}

    <!-- Image -->
    <div class="form-group">
        <label>Upload Image</label>
        <input type="file" name="image" id="image">
    </div>

    <!-- About -->
    <div class="form-group">
        <label for="about">About you</label>
        <textarea name="about" id="about" rows="5" placeholder="Introduce yourself to the the community in less than 300 characters" class="form-control"
            autofocus
            data-parsley-maxlength="300"
            data-parsley-maxlength-message="The about me field must be less than 300 characters long."
        >{{ $user->isTeacher() ? $user->teacher->about : $user->student->about  }}</textarea>

        <!-- Button -->
        <button class="btn btn-success btn-block text-uppercase ls">
            Save changes
        </button>
    </div>

</form>