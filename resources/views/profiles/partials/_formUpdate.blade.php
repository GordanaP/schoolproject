<form action="{{ route('profiles.update', $user) }}" method="POST" enctype="multipart/form-data"
    data-parsley-validate=""
    data-parsley-trigger="keyup"
    data-parsley-validation-threshold="1"
>

    {{ csrf_field() }}
    {{ method_field('PUT') }}

    @can('access', $user)
        <div class="form-group">
            <label>Role <span class="asterisk">*</span></label>
            <p class="admin__checkbox" id="#updateProfile" style="margin-left: 0;">
                @foreach ($roles as $role)
                    <input type="checkbox" value="{{ $role->id }}" disabled=""
                        @if (is_array($ids = $user->roles->pluck('id')->toArray()))
                            @foreach ($ids as $role_id)
                                {{ checked($role->id, $role_id) }}
                            @endforeach
                        @endif
                    />
                    <span class="name">{{ ucfirst($role->name) }}</span>
                @endforeach
            </p>
        </div>

        <!-- First name -->
        <div class="form-group">
            <label>First Name <span class="asterisk">*</span></label>
            <input type="text" class="form-control" value="{{ $user->isTeacher() ? $user->teacher->first_name : $user->student->first_name }}" disabled="" />
        </div>

        <!-- Last name -->
        <div class="form-group">
            <label>Last Name <span class="asterisk">*</span></label>
            <input type="text" class="form-control" value="{{ $user->isTeacher() ? $user->teacher->last_name : $user->student->last_name }}" disabled="" />
        </div>

        <!-- Birth date -->
        <div class="form-group">
            <label>Date of birth <span class="asterisk">*</span></label>
            <input type="text" id="dob" class="form-control" value="{{ $user->isTeacher() ? $user->teacher->dob->format('Y-m-d') : $user->student->dob->format('Y-m-d') }}" disabled="" />
        </div>

        <!-- CWID -->
        <div class="form-group">
            <label>CWID <span class="asterisk">*</span></label>
            <input type="text" class="form-control" value="{{ $user->isTeacher() ? $user->teacher->cwid : $user->student->cwid}}" disabled="" />
        </div>

        @if ($user->isTeacher())
            <!-- Subject -->
            <div class="form-group">
                <label for="subject">Subject</label>
                <select name="subject_id[]" id="subject" class="form-control" multiple>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">
                            {{ $subject->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Classroom -->
            <div class="form-group">
                <label for="classroom">Class</label>
                <select name="classroom_id[]" id="classroom" multiple>
                    @foreach ($classrooms as $classroom)
                        <option value="{{ $classroom->id }}">
                            {{ $classroom->label }}
                        </option>
                    @endforeach
                </select>
            </div>
        @else
            <div class="form-group">
                <label for="classroom_id">Class</label>
                <select name="classroom_id" id="classroom_id" class="form-control">
                    <option selected disabled>Select a classroom</option>
                    @foreach ($classrooms as $classroom)
                        <option value="{{ $classroom->id }}"
                            {{ selected($classroom->id, $user->student->classroom_id) }}
                        >
                            {{ $classroom->label }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif
    @endcan

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