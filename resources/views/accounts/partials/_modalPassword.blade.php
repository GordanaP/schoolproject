<div class="modal fade" tabindex="-1" role="dialog" id="passwordModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <i class="icon_lock"></i> Reset password
                </h4>
            </div>

            <div class="modal-body">
                <!-- First name-->
                <div class="form-group">
                    <label for="first_name">First name: <span class="asterisk">*</span></label>
                    <input type="text" class="form-control" name="first_name" id="first_name" readonly="" />
                </div>

                <!-- Last name -->
                <div class="form-group">
                    <label for="last_name">Last name: <span class="asterisk">*</span></label>
                    <input type="text" class="form-control" name="last_name" id="last_name" readonly="" />
                </div>

                <!-- Birth date -->
                <div class="form-group">
                    <label for="dob">Date of birth: <span class="asterisk">*</span></label>
                    <input type="text" name="dob" id="dob" class="form-control" readonly="" />
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary" id="updatePassword" data-dismiss="modal">
                    Save changes
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->