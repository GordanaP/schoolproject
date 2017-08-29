<option value="" selected="" disabled="">Select a classroom</option>
@foreach ($user->teacher->subjects as $subj)
    @if ($subj->id == $subject->id)
        <option value="{{ $subj->pivot->classroom_id }}">
            {{ $subj->pivot->classroom_id }}
        </option>
    @endif
@endforeach
