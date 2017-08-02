<form action="{{ route('profiles.update', $user) }}" method="POST" id="myForm" enctype="multipart/form-data"
    data-parsley-validate=""
    data-parsley-trigger="keyup"
    data-parsley-validation-threshold="1"
>

    {{ csrf_field() }}
    {{ method_field('PUT') }}

    @if (Request::is('profiles/*'))
        <!-- Role -->
        <div class="form-group">
            <label for="role_id">Role <span class="asterisk">*</span></label>
            <p class="admin__checkbox" id="#updateProfile" style="margin-left: 0;">
                @foreach ($roles as $role)
                    <input type="checkbox" name="role_id[]" id="role_id_{{ $role->id }}" value="{{ $role->id }}"
                        data-parsley-required=""
                        data-parsley-mincheck="1"
                        data-parsley-required-message="The role is required."
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
            <label for="first_name">First Name <span class="asterisk">*</span></label>
            <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $user->isTeacher() ? $user->teacher->first_name : $user->student->first_name }}"
                data-parsley-required=""
                data-parsley-pattern="/^[a-zA-Z]*$/"
                data-parsley-maxlength="50"
                data-parsley-required-message="The first name is required"
                data-parsley-pattern-message="The value is invalid. Only letters are allowed."
                data-parsley-maxlength-message="The first name must be less than 50 characters long."
            />
        </div>

        <!-- Last name -->
        <div class="form-group">
            <label for="last_name">Last Name <span class="asterisk">*</span></label>
            <input type="text" name="last_name" id="last_name" class="form-control" value="{{ $user->isTeacher() ? $user->teacher->last_name : $user->student->last_name }}"
                data-parsley-required=""
                data-parsley-pattern="/^[a-zA-Z]*$/"
                data-parsley-maxlength="50"
                data-parsley-required-message="The last name is required"
                data-parsley-pattern-message="The value is invalid. Only letters are allowed."
                data-parsley-maxlength-message="The last name must be less than 50 characters long."
            />
        </div>

        <!-- Birth date -->
        <div class="form-group">
            <label for="dob">Date of birth <span class="asterisk">*</span></label>
            <input type="text" name="dob" id="dob" class="form-control" placeholder="yyyy-mm-dd" value="{{ $user->isTeacher() ? $user->teacher->dob->format('Y-m-d') : $user->student->dob->format('Y-m-d') }}"
                data-parsley-required=""
                data-parsley-required-message="The date of birth is required."
            />
        </div>

        @if ($user->isTeacher())
            <!-- Subject -->
            <div class="form-group">
                <label for="subject">Subject</label>
                <select name="subject_id" id="subject_id" class="form-control">
                    <option disabled selected>Select a subject</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">
                            {{ $subject->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Classroom --}}
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
                    <option value="">I1</option>
                    <option value="">I2</option>
                </select>
            </div>
        @endif
    @endif

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