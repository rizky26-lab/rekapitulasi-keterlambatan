<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand mt-4 mb-3">
            <div class="logo">
                <img class="mb-1 rounded-circle" src="{{ asset('assets') }}/img/logo.png" alt="" width="50" height="50" >
                <a href="">Shinkai</a>
            </div>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <img src="{{ asset('assets') }}/img/logo.png" alt="" width="50" height="50">
        </div>
        <ul class="sidebar-menu">
            <li><a class="nav-link <?= $page == 'dashboard' ? 'active' : '' ?>" href="/"><i class="fa-solid fa-house"></i> <span>Dashboard</span></a></li>
            <li class="nav-item dropdown <?= $page == 'user' || $page == 'rayon' || $page == 'rombel' || $page == 'student' ? 'active' : '' ?>">
                <a href="#" class="nav-link has-dropdown"><i class="fa-solid fa-hands-holding-child"></i>
                    <span>Data Master</span></a>
                <ul class="dropdown-menu">
                    <li class=" <?= $page == 'user' ? 'active' : '' ?>"><a class="nav-link" href="/user"><i class="fa-solid fa-user"></i> <span>Data User</span></a></li>
                    <li class=" <?= $page == 'rayon' ? 'active' : '' ?>"><a class="nav-link" href="/rayon"><i class="fa-solid fa-book"></i> <span>Data Rayon</span></a></li>
                    <li class=" <?= $page == 'rombel' ? 'active' : '' ?>"><a class="nav-link" href="/rombel"><i class="fa-solid fa-computer"></i> <span>Data Rombel</span></a></li>
                    <li class=" <?= $page == 'student' ? 'active' : '' ?>"><a class="nav-link" href="/student"><i class="fa-solid fa-address-card"></i> <span>Data Student</span></a></li>
                </ul>
            </li>
            <li><a class="nav-link <?= $page == 'late' ? 'active' : '' ?>" href="/late"><i class="fa-solid fa-user-cog"></i> <span>Late</span></a></li>
        </ul>
    </aside>
</div>
