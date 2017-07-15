<table class="table admin__table" id="adminTable">

    <thead>
        <th class="text-center" width="100px">
            <i class="fa fa-cog"></i>
        </th>
        <th class="text-uppercase"  width="300px">Name</th>
        <th class="text-uppercase">Email</th>
        <th class="text-uppercase">Role</th>
    </thead>

    <tbody>
        @foreach ($users as $user)
        <tr>
            <td class="text-center flex justify-center"  width="100px">

                <a href="{{ route('accounts.edit', $user) }}" class="btn btn-warning btn-sm">
                    <i class="fa fa-pencil-square-o"></i>
                </a>

                <form action="{{ route('accounts.destroy', $user) }}" method="POST">

                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete the account?')">
                        <i class="fa fa-trash"></i>
                    </button>

                </form>

            </td>
            <td width="300px">
                <a href="#">
                    {{ $user->name }}
                </a>
            </td>
            <td>{{ $user->email }}</td>
            <td>
                @foreach ($user->roles as $role)
                    {{ $role->name }}
                @endforeach
            </td>
        </tr>
        @endforeach
    </tbody>

</table>