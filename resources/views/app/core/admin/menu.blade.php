<li class="nav-item mT-30 active">
    <a class="sidebar-link" href="/dashboard">
        <span class="icon-holder">
            <i class="c-blue-500 ti-home"></i>
        </span>
        <span class="title">Dashboard</span>
    </a>
</li>
@include('app.admin.menu')
<li class="nav-item dropdown">
    <a class="dropdown-toggle" href="javascript:void(0);">
        <span class="icon-holder">
            <i class="c-black-500 ti-settings"></i>
        </span>
        <span class="title">Settings</span> <span class="arrow"><i class="ti-angle-right"></i></span>
    </a>
    <ul class="dropdown-menu">
        <li><a class="sidebar-link" href="/role">Role</a></li>
        <li><a class="sidebar-link" href="/role-task">Role Task</a></li>
    </ul>
</li>