@extends('layouts.admin')

@section('title', '| Adm | Create Account')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Gabriela" rel="stylesheet">
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
                    <a href="#" class="btn btn-default btn-sm pull-right text-uppercase">
                       <i class="icon_profile"></i> View profile
                    </a>
                </h2>
            @endslot

            @slot('body')
                <form action="{{ route('accounts.update', $user) }}" method="POST" class="form-horizontal">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    @include('accounts.partials._formCreate', [
                        'first_name' => $user->hasRole('student') ? $user->student->first_name : $user->teacher->first_name,
                        'last_name' => $user->hasRole('student') ? $user->student->last_name : $user->teacher->last_name,
                        'ids' => $user->roles->pluck('id')->toArray(),
                        'button' => 'Save changes',
                        'class' => 'account__btn__class',
                    ])

                </form>
            @endslot
        @endcomponent
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>

    <script>

        // Initialize select 2
        $('#role_id').select2({
            placeholder: 'Select roles',
            tags:true,
        });

        // Set random password
        // <input type="text" id="password" onkeyup="setPassword()"
        function setPassword()
        {
            var password = Math.random().toString(36).substring(7);

            $('#password').val(password);
        }

    </script>
@endsection