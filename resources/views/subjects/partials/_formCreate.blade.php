<!-- Name-->
<div class="form-group">
    <label for="name" class="col-md-3 control-label">Name: <span class="asterisk">*</span></label>
    <div class="col-md-8">
        <input type="text" class="form-control" name="name" id="name" placeholder="Enter subject name" value="{{ $name }}"
            data-parsley-required=""
            data-parsley-pattern="/^[a-zA-Z1-9 ]*$/"
            data-parsley-maxlength="50"
            data-parsley-required-message="The subject is required."
            data-parsley-pattern-message="The value is invalid. Only letters, numbers, and spaces are allowed."
            data-parsley-maxlength-message="The subject must be less than 50 characters long."
        />
    </div>
</div>

<!-- Button -->
<div class="form-group">
    <div class="col-md-6 col-md-offset-3">
        <button type="submit" class="btn text-uppercase ls admin__submit" >
            {{ $button }}
        </button>
    </div>
</div>