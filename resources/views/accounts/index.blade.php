@extends('layouts.admin')

@section('title', '| Adm | Accounts')

@section('links')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
@endsection

@section('content')
    @component('partials.admin._breadcrumb')
    @endcomponent

    @component('partials.admin._panel')
        @slot('heading')

            <h2>
                <img src="{{ asset('images/menu-icon.svg') }}" alt="" width="3%">
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
@endsection

@section('scripts')
    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

    <script>

        $('#adminTable').DataTable();

    </script>
@endsection