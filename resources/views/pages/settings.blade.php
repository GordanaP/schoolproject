@extends('layouts.app')

@section('title', '| Settings')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/parsley/parsley.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.css') }}">
@endsection

@section('content')

    <!-- Errors -->
    @include('errors._list')

    <div class="settings-tabs">
        <ul class="nav nav-tabs" role="tablist">
            @component('pages.partials.settings._navTab')
                @slot('status')
                    active
                @endslot

                @slot('title')
                    <a href="#account" role="tab" data-toggle="tab">
                        <h4 class="nav-tabs__title">
                            <i class="icon_key_alt"></i> {{ ucfirst('account') }}
                        </h4>
                    </a>
                @endslot
            @endcomponent

            @component('pages.partials.settings._navTab')
                @slot('title')
                    <a href="#profile" role="tab" data-toggle="tab">
                        <h4 class="nav-tabs__title">
                            <i class="icon_profile"></i> {{ ucfirst('profile') }}
                        </h4>
                    </a>
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
                    @include('accounts.partials._formUpdatePassword')
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
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
    @if (Notify::ready())
            swal({
                title: "{{ notify()->message() }}",
                type : "{{ notify()->type() }}",
                timer: 3000
            });
    @endif

    </script>
@endsection