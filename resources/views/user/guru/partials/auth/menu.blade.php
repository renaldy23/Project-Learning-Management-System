<li class="nav-link {{ request()->is("guru/dashboard") ? "active-sidebar" : "" }}">
    <a href="{{ route("dashboard.guru") }}" class="{{ request()->is("guru/dashboard") ? "link-active-sidebar" : "text-dark " }}">
        <i class="fa fa-tachometer-alt mr-2" aria-hidden="true"></i>
        Dashboard
    </a>
</li>
<li class="nav-link 
    {{ request()->is("guru/my-course") || 
    request()->is("guru/create/lesson") || 
    request()->is("guru/create/task") || request()->is('guru/quiz/create') ? "active-sidebar" : "" }}">
    
    <a href="{{ route("my.course") }}" class="
        {{ request()->is("guru/my-course") || 
        request()->is("guru/create/lesson") || 
        request()->is("guru/create/task") || request()->is("guru/quiz/create") ? "link-active-sidebar" : "text-dark " }}">
        <i class="fa fa-book mr-2" aria-hidden="true"></i>
        My Course
    </a>
</li>
<li class="nav-link {{ request()->is("guru/my-class") ? "active-sidebar" : "" }}">
    <a href="{{ route("my.class") }}" class="{{ request()->is("guru/my-class") ? "link-active-sidebar" : "text-dark " }}">
        <i class="fas fa-building mr-2"></i>
        My Class
    </a>
</li>