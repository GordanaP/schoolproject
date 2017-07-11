<ul class="nav nav-sidebar">

    <li><a href="{{ route('pages.dashboard') }}">Dashboard</a></li>
    <li>
        <a data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Accounts
        </a>
    </li>

    <div class="collapse" id="collapseExample">
        <div class="well">
            <a href="{{ route('accounts.index') }}">All Accounts</a>
        </div>
        <div class="well">
            <a href="{{ route('accounts.create') }}">Create new</a>
        </div>
    </div>

    <li><a href="#">One more nav</a></li>
    <li><a href="#">Another nav item</a></li>
    <li><a href="#">More navigation</a></li>

</ul>
