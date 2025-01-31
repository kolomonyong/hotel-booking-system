<!-- app/Views/admin/layout/sidebar.php -->
<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?= uri_string() == 'admin/dashboard' ? 'active' : '' ?>" href="/admin/dashboard">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= uri_string() == 'admin/rooms' ? 'active' : '' ?>" href="/admin/rooms">
                    <i class="bi bi-door-closed"></i> Room Management
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= uri_string() == 'admin/bookings' ? 'active' : '' ?>" href="/admin/bookings">
                    <i class="bi bi-calendar-check"></i> Bookings
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= uri_string() == 'admin/users' ? 'active' : '' ?>" href="/admin/users">
                    <i class="bi bi-people"></i> Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/logout">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</nav>