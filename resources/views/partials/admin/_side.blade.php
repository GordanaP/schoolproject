<ul class="nav nav-sidebar">

    <li>
        <a href="{{ route('pages.dashboard') }}">
            <i class="icon_datareport" aria-hidden="true"></i> Dashboard
        </a>
    </li>

    <!-- Accounts -->
    <li>
        <a href="{{ route('accounts.create') }}">
            <i class="fa fa-user-plus" aria-hidden="true"></i> New user
        </a>
    </li>

    <!-- Profiles -->
    <li>
        <a data-toggle="collapse" href="#profiles" aria-expanded="false" aria-controls="profiles">
            <i class="fa fa-users" aria-hidden="true"></i> Users
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
