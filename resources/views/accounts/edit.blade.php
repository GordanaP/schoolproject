@extends('layouts.admin')

@section('title', '| Adm | Create Account')

@section('content')

    <div class="row col-md-8 col-md-offset-2">

        @component('partials.admin._panel')

                @slot('heading')
                    <h2> <i class="fa fa-pencil-square-o"></i> Edit account</h2>
                @endslot

                @slot('body')
                    <form action="{{ route('accounts.update', $user) }}" method="POST" class="form-horizontal">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        @include('auth.partials._formRegister', [
                            'first_name' => old('first_name'),
                            'last_name' => old('last_name'),
                            'button' => 'Save changes',
                            'class' => 'account__btn__class'
                        ])

                    </form>
                @endslot

        @endcomponent

    </div>

@endsection
