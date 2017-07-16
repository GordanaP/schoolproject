<p class="required__fields">Fields marked with * are required.</p>

<form action="{{ route('accounts.update.password', $user) }}" method="POST" class="form-horizontal"
    data-parsley-validate=""
    data-parsley-trigger="keyup"
    data-parsley-validation-threshold="1"
>
    {{ csrf_field() }}
    {{ method_field('PATCH') }}

    <!-- Password -->
    <div class="form-group">
        <label for="password" class="col-md-3 control-label">Password <span class="asterisk">*</span></label>
        <div class="col-md-8">
            <input type="password" name="password" id="password" class="form-control" placeholder="Choose a password"
                autofocus
                data-parsley-required
                data-parsley-minlength="6"
                data-parsley-required-message="The password is required."
                data-parsley-minlength-message="The password must be at least 6 characters long."
            >
        </div>
    </div>

    <!-- Confirm password -->
    <div class="form-group">
        <label for="password-confirm" class="col-md-3 control-label">Confirm Password <span class="asterisk">*</span></label>

        <div class="col-md-8">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Retype password"
                data-parsley-required
                data-parsley-equalto="#password"
                data-parsley-required-message="The password must be confirmed."
                data-parsley-equalto-message="This value must match the password."
             >
        </div>
    </div>

    <!-- Button -->
    <div class="form-group">
        <div class="col-md-6 col-md-offset-3">
            <button class="btn btn-success text-uppercase">
                Change password
            </button>
        </div>
    </div>

</form>