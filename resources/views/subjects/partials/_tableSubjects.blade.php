@if (count($subjects))

    @component('partials.admin._table')

        @slot('th')
            <th class="text-center" width="100px">
                <i class="fa fa-cog"></i>
            </th>
            <th class="text-uppercase">Name</th>
        @endslot

        @slot('rows')
            @foreach ($subjects as $subject)
                @include('subjects.partials._rowSubject')
            @endforeach
        @endslot

    @endcomponent

@else
    There are no subjects at present.
@endif