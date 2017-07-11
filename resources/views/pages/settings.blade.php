@extends('layouts.app')

@section('title', '| Settings')

@section('content')

    <div class="settings-tabs">
        <ul class="nav nav-tabs" role="tablist">
            @component('pages.partials.settings._navTab')
                @slot('status')
                    active
                @endslot
                @slot('id')
                    account
                @endslot
                @slot('icon')
                    <i class="icon_key_alt"></i>
                @endslot
            @endcomponent

            @component('pages.partials.settings._navTab')
                @slot('id')
                    profile
                @endslot
                @slot('icon')
                    <i class="icon_profile"></i>
                @endslot
            @endcomponent
        </ul>

        <div class="tab-content">
            @component('pages.partials.settings._tabPane')
                @slot('id')
                    account
                @endslot

                @slot('status')
                    active
                @endslot

                @slot('form')
                   <form action="{{ route('accounts.update.password', $user) }}" method="POST" class="form-horizontal">

                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        @include('auth.partials._formRegister', [
                            'name' => old('name') ?? $user->name,
                            'field_status' => 'disabled',
                            'email' => old('email') ?? $user->email,
                            'button' => 'Update account'
                        ])

                   </form>
                @endslot
            @endcomponent

            @component('pages.partials.settings._tabPane')
                @slot('id')
                    profile
                @endslot

                @slot('form')
                   Profile update form
                @endslot
            @endcomponent
        </div>
    </div>

@endsection