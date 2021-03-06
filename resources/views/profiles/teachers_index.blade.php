@extends('layouts.admin')

@section('title', '| Adm | Teachers')

@section('links')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
@endsection

@section('content')

    @component('partials.admin._breadcrumb')@endcomponent

    @component('partials.admin._panel')
        @slot('heading')
            <h2>
                <i class="fa fa-database" aria-hidden="true"></i> All teachers

                <a href="{{ route('profiles.students.index') }}" class="btn btn-default btn-sm pull-right text-uppercase">
                    <i class="fa fa-bars" aria-hidden="true"></i> All Students
                </a>
            </h2>
        @endslot

        @slot('body')

            <!-- Table -->
            @include('profiles.partials._tableTeachers')

            <!-- Reset password -->
            @include('accounts.partials._modalPassword')

        @endslot
    @endcomponent

@endsection

@section('scripts')
    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

    <script>

        // Initialize DataTable
        $('.admin__table').DataTable();

        @include('accounts.partials._js')

    </script>
@endsection