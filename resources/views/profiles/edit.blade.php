@extends('layouts.admin')

@section('title', '| Admin | '.$user->name)

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/parsley/parsley.css') }}">
@endsection

@section('content')

    <!-- Breadcrumb -->
    @component('partials.admin._breadcrumb') @endcomponent

    <!-- Errors -->
    @include('errors._list')

    <div class="row col-md-12">
        @component('partials.admin._panel')
            @slot('heading')
                <h2>
                    <i class="fa fa-pencil-square-o"></i>

                    {{-- {{ $user->isStudent() ? $user->student->full_name : $user->teacher->full_name }} --}}
                    Edit profile
                    <a href="{{ route('profiles.students.index') }}" class="btn btn-default btn-sm pull-right text-uppercase">
                       <i class="fa fa-bars" aria-hidden="true"></i>
                       All {{ $user->isStudent() ? 'students' : 'tecahers' }}
                    </a>
                </h2>
            @endslot

            @slot('body')
                <p class="required__fields"> Fields marked with * are required. </p>
                <div class="row">

                    <!-- Avatar -->
                    <div class="col-md-3">
                        @include('profiles.avatars._avatar')
                    </div>

                    <!-- Update profile -->
                    <div class="col-md-9">
                        @include('profiles.partials._formUpdate')
                    </div>

                </div>
            @endslot
        @endcomponent
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/parsley/parsley.min.js') }}"></script>

    <script>
        $("#subject").select2({
            placeholder: 'Select subjects'
        });

        $("#classroom").select2({
            placeholder: 'Select classrooms'
        });

        $("#image").hide();
        $('#uploadFile').one('click', function(e){
            e.preventDefault();
            $("#image").show();
        });
    </script>
@endsection