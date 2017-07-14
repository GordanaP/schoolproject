@extends('layouts.admin')

@section('title', '| Adm | Accounts')

@section('content')
    @component('partials.admin._breadcrumb')
    @endcomponent

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @component('partials.admin._panel')
                @slot('heading')

                    <h2>
                        <img src="{{ asset('images/menu-icon.svg') }}" alt="" width="5%">
                        All accounts
                        <a href="{{ route('accounts.create') }}" class="btn btn-default btn-sm pull-right text-uppercase">
                            <i class="icon_plus_alt2"></i> Add Account
                        </a>
                    </h2>

                @endslot

                @slot('body')

                    @include('accounts.partials._table')

                @endslot
            @endcomponent
        </div>
    </div>
@endsection