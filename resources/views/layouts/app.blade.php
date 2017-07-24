@extends('layouts.master')

@section('master.content')

    <div class="row">
        <div class="col-md-3">
            @section('sidebar')
                <ul>
                    <li>
                        <a href="{{ route('profiles.show', $user->name) }}">
                            My Profile
                        </a>
                    </li>
                </ul>
            @show
        </div>

        <div class="col-md-9">
            @yield('content')
        </div>
    </div>

@endsection