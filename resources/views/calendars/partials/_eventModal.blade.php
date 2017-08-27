<div class="modal fade" tabindex="-1" role="dialog" id="eventModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-top: 10px solid #00675b; background: #009688">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="color: #fefefe">
                    <i class="fa fa-pencil"></i> Create event
                </h4>
            </div>
            <div class="modal-body" style="background: #e1e2e2">

                <!-- Event -->
                <div class="form-group">
                    <label for="title">Event title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter the event title" >
                </div>

                <!-- Subject & Class-->
                {{-- @if (Auth::user()->hasRole('teacher'))
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <select name="subject" id="subject" class="form-control">
                        <option selected disabled>Select a subject</option>
                        @foreach ($teacher->groups as $group)
                            <option value="{{ $group->pivot->subject }}">
                                {{ ucfirst($group->pivot->subject) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="group">Class</label>
                    <select name="group" id="group" class="form-control">
                        <option selected disabled>Select a class</option>
                        @foreach ($teacher->groups as $group)
                            <option value="{{ $group->label }}">{{ strtoupper($group->label) }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
 --}}
                <!-- Date -->
                <div class="form-group">
                    <label for="start">Date</label>
                    <input type="text" name="start" class="form-control" id="start">
                </div>


                <!-- Time -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="time">Start time</label>
                            <input type="text" name="time" class="form-control" id="time">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end">End time</label>
                            <input type="text" name="end" class="form-control" id="end">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="background: #f5f5f6;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="background: none; border: 1px solid #c69000">
                    Close
                </button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" style="background: #fec007; border: 1px solid #fec007">Create event</button>
            </div>
        </div>
    </div>
</div>