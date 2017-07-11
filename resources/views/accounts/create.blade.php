@extends('layouts.admin')

@section('title', '| Adm | Create Account')


@section('content')

    <div class="row col-md-8 col-md-offset-2">

        @component('partials.admin._panel')

                @slot('heading')
                    <h2> <i class="fa fa-pencil"></i> Create account</h2>
                @endslot

                @slot('body')
                    <form action="{{ route('accounts.store') }}" method="POST" class="form-horizontal">

                        {{ csrf_field() }}

                        @include('auth.partials._formRegister', [
                            'name' => old('name'),
                            'email' => old('email'),
                            'button' => 'Create account',
                            'class' => 'account__btn__class'
                        ])

                    </form>
                @endslot

        @endcomponent

    </div>

@endsection