@extends('layouts.admin')

@section('title', '| Admin | '.$user->name)

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/parsley/parsley.css') }}">
@endsection

@section('content')
    @component('partials.admin._breadcrumb')
    @endcomponent

    @include('errors._list')

    <div class="row col-md-12">
        @component('partials.admin._panel')
            @slot('heading')
                <h2>
                    <i class="fa fa-pencil-square-o"></i> Edit profile
                    <a href="{{ route('accounts.edit', $user) }}" class="btn btn-default btn-sm pull-right text-uppercase">
                       <i class="icon_key"></i> View account
                    </a>
                </h2>
            @endslot

            @slot('body')
                <p class="required__fields"> Fields marked with * are required. </p>
                <div class="row">
                    <!-- Image -->
                    <div class="col-md-3">
                        @include('profiles.partials._image')
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
    </script>
@endsection