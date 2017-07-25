@extends('layouts.admin')

@section('title', '| Adm | Create Account')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/parsley/parsley.css') }}">
@endsection

@section('content')
    <!-- Breadcrumb -->
    @include('partials.admin._breadcrumb')

    <!-- Errors -->
    @include('errors._list')

    <div class="row">
        <div class=" col-md-8 col-md-offset-2">

            <!-- ADMIN PANEL -->
            @component('partials.admin._panel')

                <!-- Heading -->
                @slot('heading')
                    <h2>
                        <i class="fa fa-pencil"></i> New account
                        <a href="{{ route('accounts.index') }}" class="btn btn-default btn-sm pull-right text-uppercase">
                            <i class="fa fa-list"></i>  All Accounts
                        </a>
                    </h2>
                @endslot

                <!-- Create account -->
                @slot('body')
                    <p class="required__fields"> Fields marked with * are required. </p>

                    <form action="{{ route('accounts.store') }}" method="POST" class="form-horizontal"
                        data-parsley-validate=""
                        data-parsley-trigger="keyup"
                        data-parsley-validation-threshold="1"
                    >
                        {{ csrf_field() }}

                        @include('accounts.partials._formCreate', [
                            'first_name' => old('first_name'),
                            'last_name' => old('last_name'),
                            'ids' => old('role_id'),
                            'button' => 'Create account',
                        ])
                    </form>
                @endslot
            @endcomponent

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('vendor/parsley/parsley.min.js') }}"></script>

    <script>
        // Set random password
        // <input type="text" id="password" onkeyup="setPassword()"
        function setPassword()
        {
            var password = Math.random().toString(36).substring(8);

            $('#password').val(password);
        }
    </script>
@endsection