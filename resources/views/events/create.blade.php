@extends('layouts.app')

@section('content')

    @include('errors._list')

    <div class="row">
        <div class="col-md-8" style="border: 1px solid #eee; background: #f9f9f9">

            <form action="{{ route('events.store.event', $user) }}" method="POST">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" placeholder="Enter title" autofocus />
                </div>

                <div class="form-group">
                    <label for="subject_id">Subject</label>
                    <select class="form-control" name="subject_id" id="subject_id">
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

                <div class="form-group">
                    <label for="classroom_id">Classroom</label>
                    <select class="form-control" name="classroom_id" id="classroom_id">
                        <option value="" selected disabled>Select a classroom</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="date">Date</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      <input type="text" class="form-control"  name="date" id="date"  placeholder="yyyy-mm-dd" value="{{ old('date') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start">Start</label>
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                              <input type="text" class="form-control"  name="start" id="start"  placeholder="00:00" value="{{ old('start') }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end">End</label>
                            <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                              <input type="text" class="form-control"  name="end" id="end"  placeholder="00:00" value="{{ old('end') }}">
                            </div>
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

    <script>

        // Get classrooms for a selected subject
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

    </script>
@endsection