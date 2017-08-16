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
            <!-- Title -->
            @slot('heading')
                <h2>
                    <i class="fa fa-pencil-square-o"></i> Edit profile
                    <a href="{{ $user->isStudent() ? route('profiles.students.index') : route('profiles.teachers.index')}}" class="btn btn-default btn-sm pull-right text-uppercase">
                       <i class="fa fa-bars" aria-hidden="true"></i>
                       All {{ $user->isStudent() ? 'students' : 'teachers' }}
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
    <script src="{{ asset('vendor/moment/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/parsley/parsley.min.js') }}"></script>
    <script src="{{ asset('vendor/parsley/laravel-parsley.min.js') }}"></script>

    <script>

        $('form').parsley({
          dateFormats: ['YYYY-MM-DD']
        });

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

        $('input[type="checkbox"]').on('click', function()
        {
            if($('#role_3').is(":checked")){
                $("#role_4").attr('disabled', true);
            }
            else{
                $("#role_4").removeAttr('disabled');
            }

            if($('#role_4').is(":checked")){
                $("#role_3").attr('disabled', true);
            }
            else{
                $("#role_3").removeAttr('disabled');
            }
        })
    </script>
@endsection