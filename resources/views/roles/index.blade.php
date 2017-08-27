@extends('layouts.admin')

@section('title', '| Adm | Roles')

@section('links')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
@endsection

@section('content')

    <!-- Breadcrumbs -->
    @component('partials.admin._breadcrumb') @endcomponent

    <div class="row">
       <div class="col-md-8 col-md-offset-2">
            @component('partials.admin._panel')

                <!-- Title -->
                @slot('heading')
                    <h2>
                        <i class="fa fa-database" aria-hidden="true"></i> All roles
                        <a href="{{ route('roles.create') }}" class="btn btn-default btn-sm pull-right text-uppercase">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add Role
                        </a>
                    </h2>
                @endslot

                <!-- Table -->
                @slot('body')
                    @include('roles.partials._tableRoles')
                @endslot
            @endcomponent
        </div>
    </div>

@endsection

@section('scripts')
    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

    <script>

        // Initialize DataTable
        $('.admin__table').DataTable();

    </script>
@endsection