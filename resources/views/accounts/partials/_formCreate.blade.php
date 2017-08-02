<!-- Role -->
<div class="form-group">
    <label for="role_id" class="col-md-3 control-label">Role <span class="asterisk">*</span></label>
    <div class="col-md-offset-3" style="padding-left: 5px">
        <p class="admin__checkbox">
            @foreach ($roles as $role)
                <input type="checkbox" name="role_id[]" id="role_id_{{ $role->id }}" value="{{ $role->id }}"
                    data-parsley-required=""
                    data-parsley-mincheck="1"
                    data-parsley-required-message="The role is required."
                    @if (is_array($ids))
                        @foreach ($ids as $role_id)
                            {{ checked($role->id, $role_id) }}
                        @endforeach
                    @endif
                />
                <span class="name">{{ ucfirst($role->name) }}</span>
            @endforeach
        </p>
    </div>
</div>

<!-- First name-->
<div class="form-group">
    <label for="first_name" class="col-md-3 control-label">First name <span class="asterisk">*</span></label>
    <div class="col-md-8">
        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter first name" value="{{ $first_name ?? '' }}" {{-- {{ Request::is('accounts/*/edit') ? 'readonly' : '' }} --}}
            data-parsley-required=""
            data-parsley-pattern="/^[a-zA-Z]*$/"
            data-parsley-maxlength="50"
            data-parsley-required-message="The first name is required."
            data-parsley-pattern-message="The value is invalid. Only letters are allowed."
            data-parsley-maxlength-message="The first name must be less than 50 characters long."
        />
    </div>
</div>

<!-- Last name -->
<div class="form-group">
    <label for="last_name" class="col-md-3 control-label">Last name <span class="asterisk">*</span></label>
    <div class="col-md-8">
        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter last name" value="{{ $last_name ?? '' }}" {{-- {{ Request::is('accounts/*/edit') ? 'readonly' : '' }} --}}
            data-parsley-required=""
            data-parsley-pattern="/^[a-zA-Z]*$/"
            data-parsley-maxlength="50"
            data-parsley-required-message="The last name is required."
            data-parsley-pattern-message="The value is invalid. Only letters are allowed."
            data-parsley-maxlength-message="The last name must be less than 50 characters long."
        />
    </div>
</div>

<!-- Birth date -->
<div class="form-group">
    <label for="dob" class="col-md-3 control-label">Date of birth <span class="asterisk">*</span></label>
    <div class="col-md-8">
        <input type="text" name="dob" id="dob" class="form-control" placeholder="yyyy-mm-dd" value="{{ $dob }}" {{-- {{ Request::is('accounts/*/edit') ? 'readonly' : '' }} --}}
            data-parsley-required=""
            data-parsley-required-message="The date of birth is required."
        />
    </div>
</div>

<!-- Password -->
{{-- @if (Request::is('accounts/*/edit'))
    <div class="form-group">
        <label for="password" class="col-md-3 control-label">Password <span class="asterisk">*</span></label>
        <div class="col-md-8">
            <input  type="text" name="password" id="password" class="form-control" placeholder="******" />
        </div>
    </div>
@endif
 --}}
<!-- Button -->
<div class="form-group">
    <div class="col-md-6 col-md-offset-3">
        <button type="submit" class="btn btn-default text-uppercase ls account__button" >
            {{ $button }}
        </button>
    </div>
</div>