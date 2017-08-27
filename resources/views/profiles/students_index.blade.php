@extends('layouts.admin')

@section('title', '| Adm | Students')

@section('links')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">

    <style>
        #profileModal { padding-top: 0;}
        #profileModal .modal-content { }
        #profileModal .modal-header { border-top: 15px solid #34515e; background: #607d8b}
        #profileModal .modal-header p {margin-bottom: 0; font-family: Gabriela }
        #profileModal .modal-body {background: #e1e2e1 }
        #profileModal .modal-footer {background: #f5f5f6 }
    </style>
@endsection

@section('content')

    <div class="flex align-center alert__flash" style="display: none">
        <div class="alert__flash-type flex-1">
            <strong></strong>
        </div>
        <div class="alert__flash-message flex-3">

        </div>
    </div>

    @component('partials.admin._breadcrumb')
    @endcomponent

    @component('partials.admin._panel')
        @slot('heading')
            <h2>
                <i class="fa fa-database" aria-hidden="true"></i> All students

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

            <div class="modal fade" tabindex="-1" role="dialog" id="profileModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3 class="modal-title">
                                <span style="color:#fefefe; font-weight: bold;"></span>
                                <small style="color: #b9c6cb"></small>
                            </h3>
                            <p  style="color: #fefefe;">Classroom I</p>
                        </div>
                        <div class="modal-body" style="color: #212121; line-height: 1.6">
                            <div class="row">
                                <div  class="text-center">
                                    <div class="col-md-4">
                                        <div id="avatar">
                                            <!-- avatar -->
                                        </div>
                                        <div style="font-size: 24px; margin-top: 15px;">
                                            <i class="icon social_facebook_circle" style="color: #3b5998"></i>
                                            <i class="icon social_twitter_circle" style="color: #00aced"></i>
                                            <i class="icon social_googleplus_circle" style="color: #DF4B37"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8" id="about">
                                    <div class="row ls" style="padding-right: 15px">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae nam consequatur, reiciendis omnis esse, nesciunt incidunt. Id similique, tempore labore excepturi iste ab, molestias cupiditate harum tenetur nemo iusto eaque.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" style="background: #fe5252; border: 1px solid #fe5252">Close</button>
                            <button type="button" id="updateProfile" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

        @endslot
    @endcomponent

@endsection

@section('scripts')
    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

    <script>

        // Initialize DataTable
        $('.admin__table').DataTable();

        // Reset password
        @include('accounts.partials._js')

        // Edit profile
        $(document).on('click', '#showProfile', function(){

            $('#updateProfile').hide();

            var id = $(this).data('id');
            var url = '../profiles/' + id;
            var avatar_url = '../avatars/' + id;
            var noavatar_url = "{{ asset('images/person.png') }}";

            $('.modal-title span').empty();
            $('.modal-title small').empty();
            $('#avatar').empty();

            $.ajax({
                url: url,
                type: 'GET',
            })
            .done(function(data) {
                $('.modal-title span').append(data.user.first_name + ' ' + data.user.last_name);

                if(data.avatar == 'avatar')
                {
                    $('<img>', {
                        src: avatar_url,
                        alt: 'Avatar',
                        width: '80%'
                   })
                   .appendTo('#avatar');
                }
                else
                {
                    $('<img>', {
                        src: noavatar_url,
                        alt: 'Name of Image',
                        width: '80%'
                    })
                    .appendTo('#avatar');
                }

                //Append classroom or subjst dependong on the role

                $('.modal-title small').append(data.role);
            });
        });

    </script>
@endsection