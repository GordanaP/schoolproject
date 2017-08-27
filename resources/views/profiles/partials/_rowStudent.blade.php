<tr>
    <!-- Action buttons -->
    <td class="text-center flex justify-center"  width="100px">
        <a href="{{ route('profiles.edit', $student->user->name) }}" class="btn btn-warning btn-sm">
            <i class="fa fa-pencil"></i>
        </a>

        <form action="{{ route('accounts.destroy', $student->user->name) }}" method="POST">

            {{ csrf_field() }}
            {{ method_field('DELETE') }}

            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete the account?')">
                <i class="fa fa-trash"></i>
            </button>

        </form>
    </td>

    <!-- Name -->
    <td>
        <a href="" id="showProfile" data-id={{ $student->user->name }} data-toggle="modal" data-target="#profileModal">
            {{ $student->full_name }}
        </a>
    </td>

    <!-- Cwid -->
    <td>{{ $student->cwid }}</td>

    <!-- Date of birth -->
    <td>{{ dob($student->dob) }}</td>

    <!-- Subjects -->
    <td>
        I 2
    </td>

    <!-- Reset password -->
    <td>
        <a href="" id="editPassword" data-id="{{ $student->user->name }}" data-dob="{{ dob($student->dob) }}" data-toggle="modal" data-target="#passwordModal">Reset password</a>
    </td>
</tr>