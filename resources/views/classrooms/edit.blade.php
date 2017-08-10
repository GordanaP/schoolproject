@extends('layouts.admin')

@section('title', '| Adm | ' .$classroom->label)

@section('links')
    <link rel="stylesheet" href="{{ asset('vendor/parsley/parsley.css') }}">
@endsection

@section('content')

    <!-- Breadcrumb -->
    @component('partials.admin._breadcrumb') @endcomponent

    <!-- Errors -->
    @include('errors._list')

    <div class="row">
        <div class=" col-md-8 col-md-offset-2">

            @component('partials.admin._panel')

                <!-- Title -->
                @slot('heading')
                    <h2>
                        <i class="fa fa-pencil-square-o"></i> Edit classroom
                        <a href="{{ route('classrooms.index') }}" class="btn btn-default btn-sm pull-right text-uppercase">
                            <i class="fa fa-bars" aria-hidden="true"></i> All classrooms
                        </a>
                    </h2>
                @endslot

                <!-- Form -->
                @slot('body')
                    <p class="required__fields"> Fields marked with * are required. </p>

                    <form action="{{ route('classrooms.update', $classroom) }}" method="POST" class="form-horizontal"
                        data-parsley-validate=""
                        data-parsley-trigger="keyup"
                        data-parsley-validation-threshold="1"
                    >
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        @include('classrooms.partials._formCreate', [
                            'label' => $classroom->label,
                            'button' => 'Save changes'
                        ])

                    </form>
                @endslot

            @endcomponent

        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('vendor/parsley/parsley.min.js') }}"></script>
@endsection