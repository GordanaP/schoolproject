<!-- Name-->
<div class="form-group">
    <label for="name" class="col-md-3 control-label">Name: <span class="asterisk">*</span></label>
    <div class="col-md-8">
        <input type="text" class="form-control" name="name" id="name" placeholder="Enter role name" value="{{ $name }}"
            data-parsley-required=""
            data-parsley-pattern="/^[a-zA-Z ]*$/"
            data-parsley-maxlength="50"
            data-parsley-required-message="The role is required."
            data-parsley-pattern-message="The value is invalid. Only letters and spaces are allowed."
            data-parsley-maxlength-message="The role must be less than 50 characters long."
        />
    </div>
</div>

<!-- Button -->
<div class="form-group">
    <div class="col-md-6 col-md-offset-3">
        <button type="submit" class="btn btn-success text-uppercase ls {{ $class ?? '' }}" >
            {{ $button }}
        </button>
    </div>
</div>