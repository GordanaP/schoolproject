<!-- Label -->
<div class="form-group">
    <label for="label" class="col-md-3 control-label">Label: <span class="asterisk">*</span></label>
    <div class="col-md-8">
        <input type="text" class="form-control" name="label" id="label" placeholder="Enter classroom label" value="{{ $label }}"
            data-parsley-required=""
            data-parsley-pattern="/^[a-zA-Z1-9-_]*$/"
            data-parsley-maxlength="10"
            data-parsley-required-message="The classroom value is required."
            data-parsley-pattern-message="The value is invalid. Only letters, numbers, dashes, and underscores are allowed."
            data-parsley-maxlength-message="The classroom value must be less than 10 characters long."
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