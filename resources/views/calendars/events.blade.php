@extends('layouts.master')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/fullcalendar/fullcalendar.min.css') }}">
    <link rel="stylesheet" type="media" href="{{ asset('vendor/fullcalendar/fullcalendar.print.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datepicker/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/parsley/parsley.css') }}">
@endsection


@section('master.content')

    <!-- Message -->
    @include('errors._list')

    <!-- Event modal -->
    @include('calendars.partials._eventModal')

    <!-- Calendar -->
    <div id="calendar"></div>

@endsection

@section('scripts')
    <script src="{{ asset('vendor/moment/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/fullcalendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('vendor/datepicker/jquery-ui.js') }}"></script>
    <script src="{{ asset('vendor/parsley/parsley.min.js') }}"></script>
    <script src="{{ asset('vendor/parsley/laravel-parsley.min.js') }}"></script>

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

        // Calendar
        $('#calendar').fullCalendar({
            customButtons:{
                newEvent: {
                    text: 'New event',
                    click: function(event, jsEvent, view){
                         window.location.href = '../events/create/' + user;
                    },
                }
            },
            header: {
                left: 'prev,next tkoday newEvent',
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

@endsection