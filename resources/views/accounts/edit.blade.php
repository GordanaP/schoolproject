@extends('layouts.admin')

@section('title', '| Adm | Create Account')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/parsley/parsley.css') }}">
@endsection

@section('content')

    <!-- Breadcrumb -->
    @component('partials.admin._breadcrumb') @endcomponent

    <!-- Errors -->
    @include('errors._list')

    <div class="row">
        <div class=" col-md-8 col-md-offset-2">

            <!-- ADMIN PANEL -->
            @component('partials.admin._panel')

                <!-- Heading -->
                @slot('heading')
                    <h2>
                        <i class="fa fa-pencil-square-o"></i> Edit account
                        <a href="{{ route('profiles.edit', $user) }}" class="btn btn-default btn-sm pull-right text-uppercase">
                           <i class="icon_profile"></i> View profile
                        </a>
                    </h2>
                @endslot

                <!-- Edit account -->
                @slot('body')
                    <p class="required__fields"> Fields marked with * are required. </p>

                    <form action="{{ route('accounts.update', $user) }}" method="POST" class="form-horizontal"
                        data-parsley-validate=""
                        data-parsley-trigger="keyup"
                        data-parsley-validation-threshold="1"
                    >

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        @include('accounts.partials._formCreate', [
                            'first_name' => $user->isTeacher() ? $user->teacher->first_name : $user->student->first_name,
                            'last_name' => $user->isTeacher() ? $user->teacher->last_name : $user->student->last_name,
                            'dob' => $user->isTeacher() ? $user->teacher->dob->format('Y-m-d') : $user->student->dob->format('Y-m-d'),
                            'ids' => $user->roles->pluck('id')->toArray(),
                            'button' => 'Save changes',
                        ])

                    </form>
                @endslot
            @endcomponent

        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('vendor/parsley/parsley.min.js') }}"></script>
@endsection