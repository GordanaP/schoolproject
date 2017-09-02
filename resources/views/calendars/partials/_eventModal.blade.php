<div class="modal fade" tabindex="-1" role="dialog" id="eventModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="">
                    <i class="fa fa-pencil"></i> Create event
                </h4>
            </div>

            <div class="modal-body" id="eventForm">

                @include('calendars.partials._eventForm')

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary" id="createEvent" data-user="{{ $user->name }}">
                    Create event
                </button>
            </div>
        </div>
    </div>
</div>