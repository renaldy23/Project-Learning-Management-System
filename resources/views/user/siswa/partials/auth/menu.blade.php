<li class="nav-link {{ request()->is("siswa/dashboard") ? "active-sidebar" : "" }}">
    <a href="{{ route("dashboard.siswa") }}" class="{{ request()->is("siswa/dashboard") ? "link-active-sidebar" : "text-dark " }}">
        <i class="fa fa-tachometer-alt mr-2" aria-hidden="true"></i>
        Dashboard
    </a>
</li>
<li class="nav-link {{ request()->is("siswa/siswa-course") ? "active-sidebar" : "" }}">
    <a href="{{ route("siswa.course") }}" class="{{ request()->is("siswa/siswa-course") ? "link-active-sidebar" : "text-dark " }}">
        <i class="fa fa-book mr-2" aria-hidden="true"></i>
        Course
    </a>
</li>
<li class="nav-link {{ request()->is("siswa/my-assignment") ? "active-sidebar" : "" }}">
    <a href="{{ route("my-assignment") }}" class="{{ request()->is("siswa/my-assignment") ? "link-active-sidebar" : "text-dark " }}">
        <i class="fa fa-copy mr-2" aria-hidden="true"></i>
        My Submission
    </a>
</li>
<li class="nav-link {{ request()->is("siswa/grades") ? "active-sidebar" : "" }}">
    <a href="{{ route("grades") }}" class="{{ request()->is("siswa/grades") ? "link-active-sidebar" : "text-dark " }}">
        <i class="fas fa-poll-h mr-2"></i>
        Grades
    </a>
</li>