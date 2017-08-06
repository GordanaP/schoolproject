@if (count($teachers))

@component('partials.admin._table')

    @slot('rows')
        @foreach ($teachers as $teacher)
            @include('profiles.partials._rowTeacher')
        @endforeach
    @endslot

@endcomponent

@else
    There are no teachers at present.
@endif