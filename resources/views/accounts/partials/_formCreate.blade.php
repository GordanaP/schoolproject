<!-- Role -->
<div class="form-group">
    <label for="role_id" class="col-md-3 control-label">Role <span class="asterisk">*</span></label>
    <div class="col-md-offset-3" style="padding-left: 5px">
        <p class="admin__checkbox">
            @foreach ($roles as $role)
                <input type="checkbox" name="role_id[]" id="role_id_{{ $role->id }}" value="{{ $role->id }}"    data-parsley-required
                    data-parsley-mincheck="1"
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

<!-- First name & last name-->
@if (Request::is('accounts/create'))
    <div class="form-group">
        <label for="first_name" class="col-md-3 control-label">First Name <span class="asterisk">*</span></label>
        <div class="col-md-8">
            <input type="text" name="first_name" id="first_name" placeholder="Enter first name" class="form-control" value="{{ $first_name ?? '' }}"
                autofocus
                data-parsley-required=""
                data-parsley-pattern="/^[a-zA-Z]*$/"
                data-parsley-maxlength="30"
                data-parsley-required-message="The first name is required"
                data-parsley-pattern-message="The value is invalid. Only letters are allowed."
                data-parsley-maxlength-message="The first name must be less than 30 characters long."
            />
        </div>
    </div>

    <div class="form-group">
        <label for="last_name" class="col-md-3 control-label">Last Name <span class="asterisk">*</span></label>
        <div class="col-md-8">
            <input type="text" name="last_name" id="last_name" placeholder="Enter last name" class="form-control" value="{{ $last_name ?? '' }}"
                data-parsley-required=""
                data-parsley-pattern="/^[a-zA-Z]*$/"
                data-parsley-maxlength="30"
                data-parsley-required-message="The last name is required"
                data-parsley-pattern-message="The value is invalid. Only letters are allowed."
                data-parsley-maxlength-message="The last name must be less than 30 characters long."
            />
        </div>
    </div>
@endif

<!-- User name -->
@if (Request::segment(3) == 'edit')
    <div class="form-group">
        <label for="name" class="col-md-3 control-label">User Name <span class="asterisk">*</span></label>
        <div class="col-md-8">
            <input type="text" name="name" id="name" class="form-control" value="{{ $name ?? '' }}" readonly="" />
        </div>
    </div>
@endif

<!-- Password -->
<div class="form-group">
    <label for="password" class="col-md-3 control-label">Password <span class="asterisk">*</span></label>
    <div class="col-md-8">
        <input  type="text" name="password" id="password" class="form-control" placeholder="******" onkeypress="setPassword()"
            @if (Request::is('accounts/create'))
                data-parsley-required=""
                data-parsley-required-message="The password is required"
            @endif
            data-parsley-minlength="6"
            data-parsley-minlength-message="The password must be at least 6 characters long."
        />
    </div>
</div>

<!-- Button -->
<div class="form-group">
    <div class="col-md-6 col-md-offset-3">
        <button type="submit" class="btn btn-default text-uppercase ls account__button" >
            {{ $button }}
        </button>
    </div>
</div>