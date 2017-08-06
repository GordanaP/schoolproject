<tr>
    <!-- Action buttons -->
    <td class="text-center flex justify-center"  width="100px">
        <a href="{{ route('profiles.edit', $student->user->name) }}" class="btn btn-warning btn-sm">
            <i class="fa fa-pencil-square-o"></i>
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
    <td>{{ $student->full_name }}</td>

    <!-- Cwid -->
    <td>{{ $student->cwid }}</td>

    <!-- Date of birth -->
    <td>{{ $student->dob->format('Y-m-d') }}</td>

    <!-- Subjects -->
    <td>
        I 2
    </td>
</tr>