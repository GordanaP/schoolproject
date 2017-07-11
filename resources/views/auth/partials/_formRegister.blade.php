<!-- Name -->
<div class="form-group">
    <label for="name" class="col-md-3 control-label">Name</label>
    <div class="col-md-8">
        <input type="text" name="name" id="name" placeholder="Choose a name" class="form-control" value="{{ $name }}" {{ $field_status ?? '' }}>
    </div>
</div>

<!-- Email -->
<div class="form-group">
    <label for="email" class="col-md-3 control-label">E-Mail Address</label>
    <div class="col-md-8">
        <input  type="text"  name="email" id="email" class="form-control" placeholder="example@domain.com" value="{{ $email }}" {{ $field_status ?? '' }}>
    </div>
</div>

<!-- Password -->
<div class="form-group">
    <label for="password" class="col-md-3 control-label">Password</label>
    <div class="col-md-8">
        <input  type="password" name="password" id="password" class="form-control" placeholder="******">
    </div>
</div>

<!-- Confirm password -->
<div class="form-group">
    <label for="password-confirm" class="col-md-3 control-label">Retype Password</label>
    <div class="col-md-8">
        <input type="password" name="password_confirmation" id="password-confirm" class="form-control" placeholder="******">
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