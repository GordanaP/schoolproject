@if (count($students))

@component('partials.admin._table')

    @slot('rows')
        @foreach ($students as $student)
            @include('profiles.partials._rowStudent')
        @endforeach
    @endslot

@endcomponent

@else
    There are no students at present.
@endif
