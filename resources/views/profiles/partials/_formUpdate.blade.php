<form action="{{ route('profiles.update', $user) }}" method="POST"
    data-parsley-validate=""
    data-parsley-trigger="keyup"
    data-parsley-validation-threshold="1"
>

    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <!-- Role -->
    <div class="form-group">
        <label style="margin-right: 10px;">Role: <span class="asterisk">*</span></label>
            @foreach ($roles as $role)
                @if ($user->isStudent())
                    @if ($role->id == 2)
                        @continue;
                    @endif
                @endif

                @if ($user->isTeacher())
                    @if ($role->id == 1)
                        @continue;
                    @endif
                @endif

                <input type="checkbox" name="role_id[]" id="role_{{ $role->id }}" value="{{ $role->id }}"
                    @if (is_array($ids = $user->roles->pluck('id')->toArray()))
                        @foreach ($ids as $role_id)
                            {{ checked($role->id, $role_id) }}
                        @endforeach
                    @endif
                />
                <span class="name" style="margin-right: 20px">{{ ucfirst($role->name) }}</span>
            @endforeach
    </div>

    <!-- Gender -->
    <div class="form-group">
        <label style="margin-right: 10px">Gender: <span class="asterisk">*</span></label>
        <label class="radio-inline">
            <input type="radio" name="gender" id="male" value="M"
                @if ($user->isStudent())
                    {{ checked('M', $user->student->gender) }}
                @else
                    {{ checked('M', $user->teacher->gender) }}
                @endif
            /> Male
        </label>
        <label class="radio-inline">
            <input type="radio" name="gender" id="female" value="F"
                @if ($user->isStudent())
                    {{ checked('F', $user->student->gender) }}
                @else
                    {{ checked('F', $user->teacher->gender) }}
                @endif
            /> Female
        </label>
    </div>

    <!-- CWID & email-->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>CWID</label>
                <input type="text" class="form-control" value="{{ $user->isTeacher() ? $user->teacher->cwid : $user->student->cwid}}" readonly="" />
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" value="{{ $user->email}}" readonly="" />
            </div>
        </div>
    </div>

    <!-- First name & last name-->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="first_name">First Name <span class="asterisk">*</span></label>
                <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $user->isTeacher() ? $user->first_name : $user->first_name }}" />
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="last_name">Last Name <span class="asterisk">*</span></label>
                <input type="text" name="last_name" id="last_name" class="form-control" value="{{ $user->isTeacher() ? $user->last_name : $user->last_name }}" />
            </div>
        </div>
    </div>

    <!-- Birth date & place-->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="dob">Date of birth <span class="asterisk">*</span></label>
                <input type="text" name="dob" id="dob" class="form-control" value="{{ $user->isTeacher() ? $user->teacher->dob->format('Y-m-d') : $user->student->dob->format('Y-m-d') }}" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="birthplace">Place of Birth</label>
                <input type="text" name="birthplace" id="birthplace" class="form-control" placeholder="Enter birthplace" value="{{ $user->birthplace }}" >
            </div>
        </div>
    </div>

    <!-- Parent name-->
    <div class="form-group">
        <label for="parent">Parent Name</label>
        <input type="text" name="parent" id="parent" class="form-control" placeholder="Enter a parent name"  value="{{ $user->parent_name}}" />
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

    <!-- About -->
    <div class="form-group">
        <label for="about">About</label>
        <textarea name="about" id="about" rows="5" placeholder="About the user" class="form-control"
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