<!-- _eventForm.blade.php -->

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
        data-parsley-date=""
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

<!-- Events.blade.php script -->
<script>

    // CSRF token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Remove all values from modal on its close
    $(".modal").on("hidden.bs.modal", function() {
        $("input, select").val("").removeClass('parsley-success parsley-error').end();
        $(".error_container").empty();
      });

    // Retrieve classrooms for a selected subject
    @include('calendars.js._ajaxClassrooms')

    // Add Parsley validation error response
    var parsley_validation_options = {
        //errorsWrapper: '',
        errorTemplate: '<span class="error-msg"></span>',
        errorClass: 'parsley-error',
    }

    // Attach Parsley validation to the modal fields
    $('#eventForm input, select').parsley(parsley_validation_options);

    // Determine valid Parsley date format
    $('#date').parsley({
      dateFormats: ['YYYY-MM-DD']
    });

    // Variables
    var user = $('#createEvent').data('user');
    var url = '../calendar/' + user;


    // Validate all the input fields on modal submit
    $('#createEvent').click(function(e)
    {
        e.preventDefault();

        var isValid = true;

        $('#eventForm input, select').each(function(){
            if($(this).parsley().validate() !== true)
                isValid = false;
        })

        // Submit form if validation is successfull
        if(isValid)
        {
            $(document).on('click', '#createEvent', function()
            {
                // Add event to calendar
                var event = {
                  title:$('#title').val(),
                  start: $('#date').val(),
                  end: $('#date').val(),
                  allDay: false,
                };

                $('#calendar').fullCalendar( 'renderEvent', event);

                // Store event into DB
                $.ajax({
                    url: url,
                    method: 'POST',
                    data : {
                        title : $('#title').val(),
                        subject_id : $('#subject_id').val(),
                        classroom_id : $('#classroom_id').val(),
                        start : $('#date').val() + ' ' + $('#start').val(),
                        end : $('#date').val() + ' ' + $('#end').val(),
                        user : user,
                    },
                    success: function(data){
                        $('#eventModal').modal('hide');
                        console.log(data);
                    }
                });
            });
        }
    });


    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month, agendaWeek, agendaDay, list'
        },
        defaultView: 'month',
        handleWindowResize: true,
        displayEventTime: false,
        showNonCurrentDates:false,
        slotDuration: '00:15:00',
        firstDay: 1,
        navLinks: true,
        editable: true,
        selectable: true,
        selectHelper: true,
        businessHours: [
            {
                dow: [ 1, 2, 3, 4, 5, 6 ],
                start: '08:00',
                end: '20:00'
            }
        ],
        select: function(start, event, jsEvent, view){
            if(Laravel.user.name == user || Laravel.user.role == 'admin')
            {
                $('#eventModal').modal('show');
            }

            start = moment(start.format());
            $('#date').val(start.format('YYYY-MM-DD'));
            $('#start').val(start.format('HH:mm'));
            $('#end').val(start.format('HH:mm'));
        },
        eventLimit: true,
        eventSources: [
            {
                url: url
            }
        ],
        eventRender: function(event, element){
          element.popover({
                title: event.title,
                content: event.start.format('DD.MM.YY HH:mm'),
                trigger: 'hover'
          });
        },
    });

</script>