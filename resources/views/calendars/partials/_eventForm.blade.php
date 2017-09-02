<!-- Event -->
<div class="form-group">
    <label for="title">Event title</label>
    <input type="text" name="title" class="form-control" id="title" placeholder="Enter the event title"
        data-parsley-trigger="keyup"
        data-parsley-validation-threshold="1"
        data-parsley-required=""
        data-parsley-pattern="/^[a-zA-Z1-9 ]*$/"
        data-parsley-maxlength="20"
        data-parsley-required-message="The title is required."
        data-parsley-pattern-message="The value is invalid. Only letters, numbers and spaces are allowed."
        data-parsley-maxlength-message="The title must be less than 20 characters long."
        data-parsley-errors-container="#title_error_container"
    />
    <div class="error_container" id="title_error_container"></div>
</div>

@if (Auth::user()->isTeacher() || Auth::user()->isSuperAdmin() || Auth::user()->isAdmin())

    <!-- Subject-->
    <div class="form-group">
        <label for="subject_id">Subject</label>
        <select name="subject_id" id="subject_id" class="form-control"
            data-parsley-trigger="keyup"
            data-parsley-validation-threshold="1"
            data-parsley-required=""
            data-parsley-in="@foreach ($user->subjects_unique as $subject){{$subject->id .','}}@endforeach"
            data-parsley-required-message="The subject is required."
            data-parsley-in-message="The subject value is invalid."
            data-parsley-errors-container="#subject_error_container"
        >
            <option value="" selected="" disabled="">Select a subject</option>
            @foreach ($user->subjects_unique as $subject)
                <option value="{{ $subject->id }}">
                    {{ ucwords($subject->name) }}
                </option>
            @endforeach
        </select>
        <div class="error_container" id="subject_error_container"></div>
    </div>

    <!-- Classroom -->
    <div class="form-group" id="classroom">
        <label for="classroom_id">Class</label>
        <select name="classroom_id" id="classroom_id" class="form-control"
            data-parsley-trigger="keyup"
            data-parsley-validation-threshold="1"
            data-parsley-required=""
            data-parsley-in="@foreach ($user->teacher->subjects as $subj){{ $subj->pivot->classroom_id .',' }}@endforeach"
            data-parsley-required-message="The classroom is required."
            data-parsley-required-in="The classroom value is invalid."
            data-parsley-errors-container="#classroom_error_container"
        >
            <option value="" selected="" disabled="">Select a classroom</option>
        </select>
        <div  class="error_container" id="classroom_error_container"></div>
    </div>

@endif

<!-- Date -->
<div class="form-group">
    <label for="date">Date</label>
    <input type="text"  class="form-control" name="date" id="date"
        data-parsley-trigger="keyup"
        data-parsley-validation-threshold="1"
        data-parsley-required=""
        data-parsley-date
        data-parsley-after="{{ validateDate(\Carbon\Carbon::yesterday()) }}"
        data-parsley-required-message="The date is required."
        data-parsley-after-message="The date must be as of today."
        data-parsley-errors-container="#date_error_container"
    />
    <div  class="error_container" id="date_error_container"></div>
</div>

<div class="row">

    <!-- Start -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="start">Start time</label>
            <input type="text"  class="form-control" name="start" id="start"
                data-parsley-trigger="keyup"
                data-parsley-validation-threshold="1"
                data-parsley-required=""
                data-parsley-pattern="/^([0-9]|0[8-9]|1[0-9]):[0-5][0-9]$/"
                data-parsley-required-message="The start time is required."
                data-parsley-pattern-message="The start time must be between 08:00 and 20:00"
                data-parsley-errors-container="#start_error_container"
            />
            <div  class="error_container" id="start_error_container"></div>
        </div>
    </div>

    <!-- End -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="end">End time</label>
            <input type="text"  class="form-control" name="end" id="end"
                data-parsley-trigger="keyup"
                data-parsley-validation-threshold="1"
                data-parsley-required=""
                data-parsley-pattern="/^([0-9]|0[8-9]|1[0-9]):[0-5][0-9]$/"
                data-parsley-required-message="The end time is required."
                data-parsley-pattern-message="The end time must be between 08:00 and 20:00"
                data-parsley-errors-container="#end_error_container"
            />
            <div class="error_container" id="end_error_container"></div>
        </div>
    </div>

</div>