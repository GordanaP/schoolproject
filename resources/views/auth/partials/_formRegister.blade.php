<!-- First name -->
<div class="form-group">
    <label for="first_name" class="col-md-3 control-label">First Name</label>
    <div class="col-md-8">
        <input type="text" name="first_name" id="first_name" placeholder="Enter first name" class="form-control" value="{{ $first_name }}" autofocus/>
    </div>
</div>

<!-- Last name -->
<div class="form-group">
    <label for="last_name" class="col-md-3 control-label">Last Name</label>
    <div class="col-md-8">
        <input type="text" name="last_name" id="last_name" placeholder="Enter last name" class="form-control" value="{{ $last_name }}" />
    </div>
</div>


<!-- Role -->
<div class="form-group">
    <label for="role_id"  class="col-md-3 control-label">Role</label>
    <div class="col-md-8">
        <select name="role_id[]" id="role_id" class="form-control" multiple style="width: 100%">
            @foreach ($roles as $role)
                <option value="{{ $role->id }}">
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<!-- Class -->
<div class="form-group" id="classroom">
    <label for="classroom_id" class="col-md-3 control-label">Class</label>
    <div class="col-md-8">
        <select name="classroom_id" id="classroom_id" class="form-control">
            <option selected disabled>Select a class</option>
            @foreach ($classes as $class)
                <option value="{{ $class->id }}">
                    {{ $class->label }}
                </option>
            @endforeach
        </select>
    </div>
</div>


<!-- Subjects -->
<div class="form-group" id="subject">
    <label for="subject_id"  class="col-md-3 control-label">Subject</label>
    <div class="col-md-8">
        <select name="subject_id[]" id="subject_id" class="form-control" multiple>
            @foreach ($subjects as $subject)
                <option value="{{ $subject->id }}">
                    {{ $subject->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<!-- Password -->
<div class="form-group">
    <label for="password" class="col-md-3 control-label">Password</label>
    <div class="col-md-8">
        <input  type="text" name="password" id="password" class="form-control" onkeyup="setPassword()" />
    </div>
</div>


<!-- Button -->
<div class="form-group">
    <div class="col-md-6 col-md-offset-3">
        <button type="submit" class="btn btn-success text-uppercase ls {{ $class ?? '' }}">
            {{ $button }}
        </button>
    </div>
</div>