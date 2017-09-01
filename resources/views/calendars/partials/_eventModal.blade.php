<div class="modal fade" tabindex="-1" role="dialog" id="eventModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header" style="border-top: 10px solid #00675b; background: #009688">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="color: #fefefe">
                    <i class="fa fa-pencil"></i> Create event
                </h4>
            </div>

            <div class="modal-body" style="background: #e1e2e2"  id="eventForm">

                <!-- Event -->
                <div class="form-group">
                    <label for="title">Event title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter the event title"
                        data-parsley-required
                        data-parsley-trigger="keydown"
                        data-parsley-errors-container="#title_error_container"
                    />
                    <div class="error_container" id="title_error_container"></div>
                </div>

                <!-- Subject & Class-->
                @if (Auth::user()->isTeacher() || Auth::user()->isSuperAdmin() || Auth::user()->isAdmin())
                <div class="form-group">
                    <label for="subject_id">Subject</label>
                    <select name="subject_id" id="subject_id" class="form-control"
                        data-parsley-required
                        data-parsley-trigger="keyup"
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

                <div class="form-group" id="classroom">
                    <label for="classroom_id">Class</label>
                    <select name="classroom_id" id="classroom_id" class="form-control"
                        data-parsley-required
                        data-parsley-trigger="keyup"
                        data-parsley-errors-container="#classroom_error_container"
                    >
                        <option value="" selected="" disabled="">Select a classroom</option>
                    </select>
                    <div  class="error_container" id="classroom_error_container"></div>
                </div>
                @endif

                <!-- Date -->
                <div class="form-group">
                    <label for="start">Date</label>
                    <input type="text"  class="form-control" name="date" id="date"
                        data-parsley-required
                        data-parsley-trigger="keyup"
                        data-parsley-errors-container="#date_error_container"
                    />
                    <div  class="error_container" id="date_error_container"></div>
                </div>

                <!-- Time -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="time">Start time</label>
                            <input type="text"  class="form-control" name="start" id="start"
                                data-parsley-required
                                data-parsley-trigger="keyup"
                                data-parsley-errors-container="#start_error_container"
                            />
                            <div  class="error_container" id="start_error_container"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end">End time</label>
                            <input type="text"  class="form-control" name="end" id="end"
                                data-parsley-required
                                data-parsley-trigger="keyup"
                                data-parsley-errors-container="#end_error_container"
                            />
                            <div class="error_container" id="end_error_container"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer" style="background: #f5f5f6;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="background: none; border: 1px solid #c69000">
                    Close
                </button>
                <button type="button" class="btn btn-primary" id="createEvent" data-user="{{ $user->name }}" style="background: #fec007; border: 1px solid #fec007">Create event</button>
            </div>
        </div>
    </div>
</div>