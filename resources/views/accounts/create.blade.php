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
    <script src="{{ asset('vendor/parsley/parsley.min.js') }}"></script>
@endsection