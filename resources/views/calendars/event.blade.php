@extends('layouts.master')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/fullcalendar/fullcalendar.min.css') }}">
    <link rel="stylesheet" type="media" href="{{ asset('vendor/fullcalendar/fullcalendar.print.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datetimepicker/css/bootstrap-material-datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datepicker/jquery-ui.css') }}">
@endsection


@section('master.content')

    @include('calendars.partials._eventModal')

    <!-- Calendar -->
    <div id="calendar"></div>

@endsection

@section('scripts')
    <script src="{{ asset('vendor/moment/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/fullcalendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('vendor/datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
    <script src="{{ asset('vendor/datepicker/jquery-ui.js') }}"></script>

    <script>

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
            $('#eventModal').modal('show');
            start = moment(start.format());

        }
    });

    </script>
@endsection

