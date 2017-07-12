@extends('layouts.admin')

@section('title', '| Adm | Create Account')

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
@endsection


@section('content')

    @include('errors._list')

    <div class="row col-md-8 col-md-offset-2">

        @component('partials.admin._panel')

                @slot('heading')
                    <h2> <i class="fa fa-pencil"></i> Create account</h2>
                @endslot

                @slot('body')
                    <form action="{{ route('accounts.store') }}" method="POST" class="form-horizontal">

                        {{ csrf_field() }}

                        @include('auth.partials._formRegister', [
                            'first_name' => old('first_name'),
                            'last_name' => old('last_name'),
                            'button' => 'Create account',
                            'class' => 'account__btn__class'
                        ])

                    </form>
                @endslot

        @endcomponent

    </div>

@endsection

@section('scripts')
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>

    <script>

        $('#classroom, #subject').hide();

        $('#role_id').change(function(){

            var roles = $('#role_id').val();

            if (jQuery.inArray("1", roles) != '-1') {

                $('#subject').hide();
                $('#classroom').show();
            }
            else if(jQuery.inArray("2", roles) != '-1') {

                $('#classroom').hide();
                $('#subject').show();
            }
            else
            {
                $('#classroom, #subject').hide();
            }
        });


        $('#role_id').select2({
            placeholder: 'Select roles',
            tags:true,
        });

        $('#subject_id').select2({
            placeholder: 'Select subjects',
            tags:true,
        });

        function setPassword()
        {
            var password = Math.random().toString(36).substring(7);

            $('#password').val(password);
        }

    </script>
@endsection