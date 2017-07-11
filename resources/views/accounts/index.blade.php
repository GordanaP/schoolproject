@extends('layouts.admin')

@section('title', '| Adm | Accounts')

@section('content')

    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            @component('partials.admin._panel')
                @slot('heading')
                    <h1><img src="{{ asset('images/menu-icon.svg') }}" alt="" width="5%"> All accounts</h1>
                @endslot

                @slot('body')
                    @include('accounts.partials._table')
                @endslot
            @endcomponent

        </div>
    </div>

@endsection