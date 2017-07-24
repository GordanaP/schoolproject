@extends('layouts.admin')

@section('title', '| Admin | '.$user->name)

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/parsley/parsley.css') }}">
@endsection

@section('content')

    @component('partials.admin._breadcrumb')
    @endcomponent

    @include('errors._list')

    <div class="row col-md-8 col-md-offset-2">
        @component('partials.admin._panel')
            @slot('heading')
                <h2>
                    <i class="fa fa-pencil-square-o"></i> Edit profile
                    <a href="{{ route('accounts.edit', $user) }}" class="btn btn-default btn-sm pull-right text-uppercase">
                       <i class="icon_key"></i> View account
                    </a>
                </h2>
            @endslot

            @slot('body')
                <form action="{{ route('profiles.update', $user) }}" method="POST" enctype="multipart/form-data"
                    data-parsley-validate=""
                    data-parsley-trigger="keyup"
                    data-parsley-validation-threshold="1"
                >

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="row">
                        <div class="col-md-3">
                            @include('profiles.partials._image')
                        </div>
                        <div class="col-md-9">
                            @include('profiles.partials._formUpdate')
                        </div>
                    </div>
                </form>
            @endslot
        @endcomponent
    </div>

@endsection


@section('scripts')
    <script src="{{ asset('vendor/parsley/parsley.min.js') }}"></script>
@endsection