<ul class="nav nav-sidebar">

    <li><a href="{{ route('pages.dashboard') }}">Dashboard</a></li>

    <!-- Accounts -->
    <li>
        <a data-toggle="collapse" href="#accounts" aria-expanded="false" aria-controls="accounts">
            Accounts
        </a>
    </li>
    <div class="collapse" id="accounts">
        <div class="well">
            <a href="{{ route('accounts.index') }}">All Accounts</a>
        </div>
        <div class="well">
            <a href="{{ route('accounts.create') }}">Create new</a>
        </div>
    </div>

    <!-- Profiles -->
    <li>
        <a data-toggle="collapse" href="#profiles" aria-expanded="false" aria-controls="profiles">
            Profiles
        </a>
    </li>
    <div class="collapse" id="profiles">
        <div class="well">
            <a href="{{ route('profiles.teachers.index') }}">Teachers</a>
        </div>
        <div class="well">
            <a href="{{ route('profiles.students.index') }}">Students</a>
        </div>
    </div>


    <li><a href="#">Another nav item</a></li>
    <li><a href="#">More navigation</a></li>

</ul>
