<table class="table admin__table" id="tableStudents">

    <thead>
        <th class="text-center" width="100px">
            <i class="fa fa-cog"></i>
        </th>
        <th class="text-uppercase">Name</th>
        <th class="text-uppercase">Cwid</th>
        <th class="text-uppercase">Date of birth</th>
        <th class="text-uppercase">Group</th>
    </thead>

    <tbody>
        @forelse ($students as $student)
        <tr>
            <!-- Action buttons -->
            <td class="text-center flex justify-center"  width="100px">
                <a href="{{ route('profiles.edit', $student->user->name) }}" class="btn btn-warning btn-sm">
                    <i class="fa fa-pencil-square-o"></i>
                </a>

            </td>

            <!-- Name -->
            <td>
                <a href="{{ route('accounts.edit', $student->user->name) }}">
                    {{ $student->full_name }}
                </a>
            </td>

            <!-- Cwid -->
            <td>
                {{ $student->cwid }}
            </td>

            <!-- Date of birth -->
            <td>
                {{ $student->dob->format('Y-m-d') }}
            </td>

            <!-- Subjects -->
            <td>
                I 2
            </td>
        </tr>
        @empty
            There are no students at this time.
        @endforelse
    </tbody>

</table>

