@if (Storage::disk('profiles')->has(filename($user->id, 'profile')))

    <div class="thumbnail">
        <img src="{{ route('profiles.show.file', $user->name) }}" alt="{{ $user->isTeacher() ? $user->teacher->full_name : $user->student->full_name }}" class="img-circle image" />
    </div>

    <div class="text-center">
        @include('profiles.partials._formDeleteImage')
    </div>

@else

    <div class="thumbnail">
        @if ($user->hasRole('teacher'))
            <img src="{{ asset('images/teacher.svg') }}" class="img-circle image" alt="Teacher Avatar">
        @else
            <img src="{{ asset('images/student-icon.svg') }}" class="img-circle image" alt="Student Avatar">
        @endif
    </div>

@endif
