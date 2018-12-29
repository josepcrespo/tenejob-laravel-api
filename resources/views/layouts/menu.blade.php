<li class="{{ Request::is('days*') ? 'active' : '' }}">
    <a href="{!! route('days.index') !!}"><i class="fa fa-edit"></i><span>Days</span></a>
</li>

<li class="{{ Request::is('shifts*') ? 'active' : '' }}">
    <a href="{!! route('shifts.index') !!}"><i class="fa fa-edit"></i><span>Shifts</span></a>
</li>

<li class="{{ Request::is('workers*') ? 'active' : '' }}">
    <a href="{!! route('workers.index') !!}"><i class="fa fa-edit"></i><span>Workers</span></a>
</li>

