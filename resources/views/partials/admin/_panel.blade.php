<div class="panel panel-default admin__panel">

    <div class="panel-heading">

        {{ $heading }}

    </div>

    <div class="panel-body">

        @if (Request::segment(2) != '')
            <p style="">Fields marked with * are required.</p>
        @endif

        {{ $body }}

    </div>

</div>