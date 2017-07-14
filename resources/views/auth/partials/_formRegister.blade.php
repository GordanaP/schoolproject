<!-- First name -->
<div class="form-group">
    <label for="first_name" class="col-md-3 control-label">First Name <span class="asterisk">*</span></label>
    <div class="col-md-8">
        <input type="text" name="first_name" id="first_name" placeholder="Enter first name" class="form-control" value="{{ $first_name }}" autofocus/>
    </div>
</div>

<!-- Last name -->
<div class="form-group">
    <label for="last_name" class="col-md-3 control-label">Last Name <span class="asterisk">*</span></label>
    <div class="col-md-8">
        <input type="text" name="last_name" id="last_name" placeholder="Enter last name" class="form-control" value="{{ $last_name }}" />
    </div>
</div>


<!-- Role -->
<div class="form-group">
    <label for="role_id"  class="col-md-3 control-label">Role <span class="asterisk">*</span></label>
    <div class="col-md-8">
        <select name="role_id[]" id="role_id" class="form-control" multiple style="width: 100%">
            @foreach ($roles as $role)
                <option value="{{ $role->id }}"
                    @if (is_array($ids))
                        @foreach ($ids as $role_id)
                            {{ selected($role->id, $role_id) }}
                        @endforeach
                    @endif
                >
                    {{ $role->role_name }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<!-- Class -->
<div class="form-group" id="classroom">
    <label for="classroom_id" class="col-md-3 control-label">Class <span class="asterisk">*</span></label>
    <div class="col-md-8">
        <select name="classroom_id" id="classroom_id" class="form-control">
            <option selected disabled>Select a class</option>
            @foreach ($classes as $class)
                <option value="{{ $class->id }}"
                    {{ selected($class->id, $class_id) }}
                >
                    {{ $class->label }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<!-- Password -->
<div class="form-group">
    <label for="password" class="col-md-3 control-label">Password <span class="asterisk">*</span></label>
    <div class="col-md-8">
        <input  type="text" name="password" id="password" class="form-control" onkeyup="setPassword()" />
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