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

    <!-- Roles -->
    <li>
        <a data-toggle="collapse" href="#roles" aria-expanded="false" aria-controls="roles">
            <i class="icon_briefcase" aria-hidden="true"></i> Roles
        </a>
    </li>
    <div class="collapse" id="roles">
        <div class="well">
            <a href="{{ route('roles.index') }}">All roles</a>
        </div>
        <div class="well">
            <a href="{{ route('roles.create') }}">New role</a>
        </div>
    </div>

    <!-- Classrooms -->
    <li>
        <a data-toggle="collapse" href="#classrooms" aria-expanded="false" aria-controls="classrooms">
            <i class="icon_flowchart_alt" aria-hidden="true"></i> Classrooms
        </a>
    </li>
    <div class="collapse" id="classrooms">
        <div class="well">
            <a href="{{ route('classrooms.index') }}">All classrooms</a>
        </div>
        <div class="well">
            <a href="{{ route('classrooms.create') }}">New classroom</a>
        </div>
    </div>

    <!-- Subjects -->
    <li>
        <a data-toggle="collapse" href="#subjects" aria-expanded="false" aria-controls="subjects">
            <i class="icon_pushpin" aria-hidden="true"></i> Subjects
        </a>
    </li>
    <div class="collapse" id="subjects">
        <div class="well">
            <a href="{{ route('subjects.index') }}">All subjects</a>
        </div>
        <div class="well">
            <a href="{{ route('subjects.create') }}">New subject</a>
        </div>
    </div>
</ul>
