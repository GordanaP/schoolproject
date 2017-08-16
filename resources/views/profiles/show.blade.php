@extends('layouts.app')

@section('title', '| ' .$user->name )

@section('content')

    <div class="row">

            <h1 style="margin-top: 0;">{{ $user->full_name }}

            <small style="font-size: 22px;margin-left: 10px;">
                @if ($user->isTeacher())
                    <img src="{{ asset('images/graduate.svg') }}" alt="" width="3%" style="margin-bottom: 10px;"></i>
                @else
                    <img src="{{ asset('images/apple.svg') }}" alt="" width="3%" style="margin-bottom: 8px;"></i>
                @endif

                <span>
                    {{ $user->roles->first()->role_name }}
                </span>
            </small></h1>

            <hr>

        <div class="col-md-3">
            @if (Storage::disk('avatars')->has(filename($user->id, 'profile')))

                <img src="{{ route('avatars.show', $user->name) }}" alt="" width="100%" class="image" />

            @else

                @if ($user->hasRole('teacher'))
                    <img src="{{ asset('images/teacher.svg') }}" class="image" alt="Teacher Avatar">
                @else
                    <img src="{{ asset('images/person.png') }}" class="image" alt="Student Avatar" width="100%" />
                @endif

            @endif

        </div>

        <div class="col-md-9">

            @if ($user->isTeacher())
                <p>
                    @foreach ($user->teacher->subjects as $subject)
                         <img src="{{ asset('images/palette.svg') }}" alt="" width="3%">
                         {{ $subject->name }}: {{ $subject->pivot->classroom_id }}
                    @endforeach
                </p>
                <p>
                    {{ $user->teacher->about }}
                </p>
            @endif

            @if ($user->isStudent())
                <p>
                    <img src="{{ asset('images/classroom.svg') }}" alt="" width="3%" style="background: margin-bottom: 8px;">
                    <span style="font-family: Gabriela; font-size: 16px">Classroom: {{ $user->student->classroom ? $user->student->classroom->label : '' }}</span>
                </p>

                <div class="row">
                    <div class="col-md-8">
                        <div class="panel panel-default" style="margin-top: 20px;">
                            <div class="panel-heading"><i class="fa fa-heart" style="color:red"></i> About {{ $user->student->name }} <i class="fa fa-heart" style="color:red"></i>
                            </div>
                            <div class="panel-body">
                                {{ $user->student->about }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

    </div>

@endsection