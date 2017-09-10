@extends('layouts.app')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/datepicker/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/timepicker/timepicker-addon.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/parsley/parsley.css') }}">

    <style type="text/css">
        td.redday span.ui-state-default {
          background: none;
        }
    </style>
@endsection

@section('content')

    @include('errors._list')

    <div class="row">
        <div class="col-md-8" style="border: 1px solid #eee; background: #f9f9f9">

            <form action="{{ route('events.store.event', $user) }}" method="POST"
                data-parsley-validate data-parsley-trigger="keyup" data-parsley-validation-threshold="1"
            >

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="title">Title</label>
                    <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-bars" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" placeholder="Enter title"    autofocus
                                data-parsley-required=""
                                data-parsley-pattern="/^[a-zA-Z1-9 ]*$/"
                                data-parsley-maxlength="20"
                                data-parsley-required-message="The title is required."
                                data-parsley-pattern-message="The value is invalid. Only letters, numbers and spaces are allowed."
                                data-parsley-maxlength-message="The title must be less than 20 characters long."
                                data-parsley-errors-container="#title_error_container"
                            />
                    </div>
                    <div class="error_container" id="title_error_container"></div>
                </div>

                <div class="form-group">
                    <label for="subject_id">Subject</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon_pushpin" aria-hidden="true"></i></span>
                        <select class="form-control" name="subject_id" id="subject_id"
                            data-parsley-required=""
                            data-parsley-in="@foreach ($user->subjects_unique as $subject){{$subject->id .','}}@endforeach"
                            data-parsley-required-message="The subject is required."
                            data-parsley-in-message="The subject value is invalid."
                            data-parsley-errors-container="#subject_error_container"
                        >
                            <option value="" selected disabled>Select a subject</option>
                            @foreach ($user->subjects_unique as $subject)
                                <option value="{{ $subject->id }}"
                                    {{ selected($subject->id, old('subject_id')) }}
                                >
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="error_container" id="subject_error_container"></div>
                </div>

                <div class="form-group">
                    <label for="classroom_id">Classroom</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon_flowchart_alt" aria-hidden="true"></i></span>
                        <select class="form-control" name="classroom_id" id="classroom_id"
                            data-parsley-required=""
                            data-parsley-in="@foreach ($user->teacher->subjects as $subj){{ $subj->pivot->classroom_id .',' }}@endforeach"
                            data-parsley-required-message="The classroom is required."
                            data-parsley-required-in="The classroom value is invalid."
                            data-parsley-errors-container="#classroom_error_container"
                        >
                            <option value="" selected disabled>Select a classroom</option>
                        </select>
                    </div>
                    <div  class="error_container" id="classroom_error_container"></div>
                </div>

                <div class="form-group">
                    <label for="date">Date</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" class="form-control"  name="date" id="date"  placeholder="yyyy-mm-dd" value="{{ old('date') }}"
                            data-parsley-trigger="change"
                            data-parsley-required=""
                            data-parsley-date=""
                            data-parsley-after="{{ validateDate(\Carbon\Carbon::yesterday()) }}"
                            data-parsley-required-message="The date is required."
                            data-parsley-after-message="The date must be as of today."
                            data-parsley-errors-container="#date_error_container"
                        >
                    </div>
                    <div  class="error_container" id="date_error_container"></div>
                </div>

                <div class="row">
                    <!-- Start -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start">Start time</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                <input type="text"  class="form-control" name="start" id="start" placeholder="00:00" value="{{ old('start') }}"
                                    data-parsley-required=""
                                    data-parsley-pattern="/(0[8-9]|1[0-9]):([0-5][0-9])/"
                                    data-parsley-required-message="The start time is required."
                                    data-parsley-pattern-message="The start time must be between 08:00 and 20:00"
                                    data-parsley-errors-container="#start_error_container"
                                />
                            </div>
                            <div  class="error_container" id="start_error_container"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end">End</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                <input type="text" class="form-control"  name="end" id="end"  placeholder="00:00" value="{{ old('end') }}"
                                    data-parsley-required=""
                                    data-parsley-pattern="/^([0-9]|0[8-9]|1[0-9]):[0-5][0-9]$/"
                                    data-parsley-required-message="The end time is required."
                                    data-parsley-pattern-message="The end time must be between 08:00 and 20:00"
                                    data-parsley-errors-container="#end_error_container"
                                />
                            </div>
                            <div class="error_container" id="end_error_container"></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn btn-success" id="newEvent" data-user={{ $user->name }}>
                        Create event
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('vendor/datepicker/jquery-ui.js') }}"></script>
    <script src="{{ asset('vendor/timepicker/timepicker-addon.js') }}"></script>
    <script src="{{ asset('vendor/parsley/parsley.min.js') }}"></script>
    <script src="{{ asset('vendor/parsley/laravel-parsley.min.js') }}"></script>

    <script>

        // Filter classrooms for a selected subject
        $(document).on('change', '#subject_id', function(){
            var subject_id = $(this).val();
            var user = $('#newEvent').data('user');

            if(subject_id)
            {
                $.ajax({
                    url : '../../classrooms/' + subject_id + '/' + user,
                    type: 'get',
                    success: function(data)
                    {
                        $('#classroom_id').html(data);
                    }
                })
            }
        });

        // Datepicker
        var myDate = new Date();
        var year = myDate.getFullYear() + 1;

        $("#date").datepicker({
            dateFormat: 'yy-mm-dd', //2017-09-05
            firstDay: 1, // Monday
            minDate: 0, // today
            maxDate: year+'-06-30',
            changeMonth:true,
            changeYear:true,
            beforeShowDay: function (date) {
                var tooltipDate = "Sunday is disabled.";
                return date.getDay() == 0 ? [false, 'redday', tooltipDate] : [true, '', ''];
            },
        });

        $("#date").on('change', function() {
            $("input[name=date]").parsley().validate();

        });

        // Timepicker
        $('#start').timepicker({
            controlType: 'select',
            oneLine: true,
            timeFormat: "HH:mm",
            hourMin: 7,
            hourMax: 19
        });

        $('#end').timepicker({
            controlType: 'select',
            oneLine: true,
            timeFormat: "HH:mm",
            hourMin: 8,
            hourMax: 19
        });


        // Determine valid Parsley date format
        $('#date').parsley({
          dateFormats: ['YYYY-MM-DD']
        });

    </script>
@endsection