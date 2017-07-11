@extends('layouts.admin')

@section('title', '| Adm | Accounts')

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            @component('partials.admin._panel')
                @slot('heading')
                    <h1><i class="fa fa-list"></i> All accounts</h1>
                @endslot
                @slot('body')
                    <table class="table">
                        <thead>
                            <th class="text-center" width="180px">
                                <i class="fa fa-cog"></i>
                            </th>
                            <th class="text-uppercase">Name</th>
                            <th class="text-uppercase">Email</th>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td class="text-center" width="180px" style="display:flex;">
                                    <a href="{{ route('accounts.edit', $user) }}" class="btn btn-warning btn-sm" style="margin-right: 5px; back">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </a>
                                    <form action="{{ route('accounts.destroy', $user) }}" method="POST">

                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" class="btn btn-danger btn-sm" style="background: firebrick; border: 1px solid #ab2121">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>

                                </td>
                                <td>
                                    <a href="#" style="color: #509195">
                                        {{ $user->name }}
                                    </a>
                                </td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endslot
            @endcomponent

        </div>
    </div>

@endsection