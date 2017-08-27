@extends('layouts.master')

@section('master.content')

    <div class="row">
        <div class="col-md-3">
            @section('sidebar')

            @show
        </div>

        <div class="col-md-9">
            @yield('content')
        </div>
    </div>

@endsection