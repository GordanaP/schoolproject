<!-- First name -->
<div class="form-group">
    <label for="first_name" class="col-md-3 control-label">First Name</label>
    <div class="col-md-8">
        <input type="text" name="first_name" id="first_name" placeholder="Enter first name" class="form-control" value="{{ $first_name ?? ' ' }}" autofocus/>
    </div>
</div>

<!-- Last name -->
<div class="form-group">
    <label for="last_name" class="col-md-3 control-label">Last Name</label>
    <div class="col-md-8">
        <input type="text" name="last_name" id="last_name" placeholder="Enter last name" class="form-control" value="{{ $last_name ?? ' '  }}" />
    </div>
</div>


<!-- Password -->
<div class="form-group">
    <label for="password" class="col-md-3 control-label">Password</label>
    <div class="col-md-8">
        <input  type="text" name="password" id="password" value="123456" class="form-control" />
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