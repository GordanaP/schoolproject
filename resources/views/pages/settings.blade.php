
@extends('layouts.app')

@section('title', '| Settings')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/parsley/parsley.css') }}">
@endsection

@section('content')

    @include('errors._list')

    <div class="settings-tabs">
        <ul class="nav nav-tabs" role="tablist">
            @component('pages.partials.settings._navTab')
                @slot('status')
                    active
                @endslot
                @slot('id')
                    account
                @endslot
                @slot('icon')
                    <i class="icon_key_alt"></i>
                @endslot
            @endcomponent

            @component('pages.partials.settings._navTab')
                @slot('id')
                    profile
                @endslot
                @slot('icon')
                    <i class="icon_profile"></i>
                @endslot
            @endcomponent
        </ul>

        <div class="tab-content">

            @component('pages.partials.settings._tabPane')
                @slot('id')
                    account
                @endslot

                @slot('status')
                    active
                @endslot

                @slot('form')

                    <p class="required__fields">Fields marked with * are required.</p>

                   <form action="{{ route('accounts.update.password', $user) }}" method="POST" class="form-horizontal"
                        data-parsley-validate=""
                        data-parsley-trigger="keyup"
                        data-parsley-validation-threshold="1"
                   >

                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

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

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button class="btn btn-success text-uppercase">
                                    Change password
                                </button>
                            </div>
                        </div>

                   </form>
                @endslot
            @endcomponent

            @component('pages.partials.settings._tabPane')
                @slot('id')
                    profile
                @endslot

                @slot('form')
                   Profile update form
                @endslot
            @endcomponent
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('vendor/parsley/parsley.min.js') }}"></script>
@endsection