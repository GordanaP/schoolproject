@extends('layouts.master')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/fullcalendar/fullcalendar.min.css') }}">
    <link rel="stylesheet" type="media" href="{{ asset('vendor/fullcalendar/fullcalendar.print.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datetimepicker/css/bootstrap-material-datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datepicker/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/parsley/parsley.css') }}">
@endsection


@section('master.content')

    <!-- Event modal -->
    @include('calendars.partials._eventModal')

    <!-- Calendar -->
    <div id="calendar"></div>

@endsection

@section('scripts')
    <script src="{{ asset('vendor/moment/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/fullcalendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('vendor/datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
    <script src="{{ asset('vendor/datepicker/jquery-ui.js') }}"></script>
    <script src="{{ asset('vendor/parsley/parsley.min.js') }}"></script>

    <script>

    // CSRF token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Retrieve classrooms for a selected subject
    @include('calendars.js._ajaxClassrooms')

    // Create event
    var parsley_validation_options = {
         //errorsWrapper: '',
         errorTemplate: '<span class="error-msg"></span>',
         errorClass: 'error',
    }

    var user = $('#createEvent').data('user');
    var url = '../calendar/' + user;

    //check if modal_div element exists on the page
    if ($('#eventForm').length > 0) {

        //Attach Parsley validation to the modal input elements
        $('#eventForm input, select').parsley(parsley_validation_options);

        // On modal submit button click, validate all the input fields
        $('#createEvent').click(function(e) {
            e.preventDefault();

            var isValid = true;

            $('#eventForm input, select').each(function(){
                if($(this).parsley().validate() !== true)
                    isValid = false;
            })

            // Submit form if validation is successfull
            if(isValid) {

                $(document).on('click', '#createEvent', function(){

                    var event = {
                      title:$('#title').val(),
                      start: $('#date').val(),
                      end: $('#date').val(),
                      allDay: false,
                    };

                    // Add to calendar
                    $('#calendar').fullCalendar( 'renderEvent', event);

                    // Store into DB
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
                    })
                })
            }
        });
    }


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

            $(".modal").on("hidden.bs.modal", function() {
                $("input, select").val("").end();
                $(".error_container").empty();
              });
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
@endsection