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

            @component('partials.admin._panel')

                <!-- Title -->
                @slot('heading')
                    <h2>
                        <i class="fa fa-pencil"></i> New account
                    </h2>
                @endslot

                <!-- Create account -->
                @slot('body')
                    <p class="required__fields"> Fields marked with * are required. </p>

                    @include('accounts.partials._formCreate')
                @endslot

            @endcomponent

        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('vendor/moment/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/parsley/parsley.min.js') }}"></script>
    <script src="{{ asset('vendor/parsley/laravel-parsley.min.js') }}"></script>

    <script>
        // set parsley data format
        $('form').parsley({
          dateFormats: ['YYYY-MM-DD']
        });

        $('input[type="checkbox"]').on('click', function(){

            if($('#role_1').is(":checked")){
                $("#role_2").attr('disabled', true);
            }
            else{
                $("#role_2").removeAttr('disabled');
            }

            if($('#role_2').is(":checked")){
                $("#role_1").attr('disabled', true);
            }
            else{
                $("#role_1").removeAttr('disabled');
            }

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