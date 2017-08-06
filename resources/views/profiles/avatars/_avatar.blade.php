@if (Storage::disk('avatars')->has(filename($user->id, 'profile')))

    <div class="thumbnail">
        <img src="{{ route('avatars.show', $user->name) }}" alt="" class="img-circle image" />
    </div>

    <div class="text-center">
        @include('profiles.avatars._formDelete')
    </div>

@else

    <div class="thumbnail">
        @if ($user->hasRole('teacher'))
            <img src="{{ asset('images/teacher.svg') }}" class="img-circle image" alt="Teacher Avatar">
        @else
            <img src="{{ asset('images/student-icon.svg') }}" class="img-circle image" alt="Student Avatar">
        @endif
    </div>

    @can('access', $user)
        <div class="text-center">
            @include('profiles.avatars._formStore')
        </div>
    @endcan

@endif

