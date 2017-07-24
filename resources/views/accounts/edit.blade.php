@extends('layouts.admin')

@section('title', '| Adm | Create Account')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/parsley/parsley.css') }}">
@endsection

@section('content')

    @component('partials.admin._breadcrumb')
    @endcomponent

    @include('errors._list')

    <div class="row col-md-8 col-md-offset-2">
        @component('partials.admin._panel')
            @slot('heading')
                <h2>
                    <i class="fa fa-pencil-square-o"></i> Edit account
                    <a href="{{ route('profiles.edit', $user) }}" class="btn btn-default btn-sm pull-right text-uppercase">
                       <i class="icon_profile"></i> View profile
                    </a>
                </h2>
            @endslot

            @slot('body')
                <form action="{{ route('accounts.update', $user) }}" method="POST" class="form-horizontal"
                    data-parsley-validate=""
                    data-parsley-trigger="keyup"
                    data-parsley-validation-threshold="1"
                >

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    @include('accounts.partials._formCreate', [
                        'ids' => $user->roles->pluck('id')->toArray(),
                        'name' => $user->name,
                        'button' => 'Save changes',
                    ])

                </form>
            @endslot
        @endcomponent
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