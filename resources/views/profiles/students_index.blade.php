@extends('layouts.admin')

@section('title', '| Adm | Students')

@section('links')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
@endsection

@section('content')

    <div class="flex align-center alert__flash" style="display: none">
        <div class="alert__flash-type flex-1">
            <strong></strong>
        </div>
        <div class="alert__flash-message flex-3">

        </div>
    </div>

    @component('partials.admin._breadcrumb') @endcomponent

    @component('partials.admin._panel')
        @slot('heading')
            <h2>
                <img src="{{ asset('images/menu-icon.svg') }}" alt="" width="3%">
                All students

                <a href="{{ route('profiles.teachers.index') }}" class="btn btn-default btn-sm pull-right text-uppercase">
                    <i class="fa fa-bars" aria-hidden="true"></i> All teachers
                </a>
            </h2>
        @endslot

        @slot('body')

            <!-- Student table -->
            @include('profiles.partials._tableStudents')

            <!-- Password Modal -->
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

        // $(document).on('click', '#editPassword', function() {

        //     var id = $(this).data('id');
        //     var url = '../profiles/' + id +'/edit';
        //     var dob = $(this).data('dob');

        //     $('#updatePassword').val(id);

        //     $.ajax({
        //         url: url,
        //         type: 'GET',
        //     })
        //     .done(function(data) {
        //         $('#first_name').val(data.first_name);
        //         $('#last_name').val(data.last_name);
        //         $('#dob').val(dob);
        //     });
        // });

        // $(document).on('click', '#updatePassword', function(){
        //     var id = $(this).val();
        //     var url = '../password/' + id;

        //     var first_name = $('#first_name').val();
        //     var last_name = $('#last_name').val();
        //     var dob = $('#dob').val();

        //     $.ajax({
        //         url: url,
        //         type: 'PATCH',
        //         data: {
        //             first_name: first_name,
        //             last_name: last_name,
        //             dob: dob
        //         }
        //     })
        //     .done(function(data) {
        //         console.log(data.message);
        //         _successMessage(data);
        //     })
        // });

        // function _successMessage(data)
        // {
        //     $('.alert__flash').show();
        //     $('.alert__flash-message').append(data.message);
        // }

    </script>
@endsection