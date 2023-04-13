<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('admin/dashboard') }}">
                <i class="mdi mdi-speedometer menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('admin/orders') ? 'active' : '' }}">
            <a class="nav-link" href="pages/forms/basic_elements.html">
                <i class="mdi mdi-shopping menu-icon"></i>
                <span class="menu-title">Orders</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('admin/category*') ? 'active' : '' }}">
            <a class="nav-link" data-bs-toggle="collapse" href="#category"
                aria-expanded="{{ Request::is('admin/category*') ? 'true' : 'false' }}">
                <i class="mdi mdi-view-grid menu-icon"></i>
                <span class="menu-title">Category</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ Request::is('admin/category*') ? 'show' : '' }}" id="category">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin/category') || Request::is('admin/category/*/edit') ? 'active' : '' }}"
                            href="{{ url('admin/category') }}">View Category</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item {{ Request::is('admin/books*') ? 'active' : '' }}">
            <a class="nav-link" data-bs-toggle="collapse" href="#books"
                aria-expanded="{{ Request::is('admin/books*') ? 'true' : 'false' }}">
                <i class="mdi mdi-library menu-icon"></i>
                <span class="menu-title">Books</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ Request::is('admin/books*') ? 'show' : '' }}" id="books">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin/books') || Request::is('admin/books/*/edit') ? 'active' : '' }}"
                            href="{{ url('admin/books') }}">View Books</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item {{ Request::is('admin/publishers') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('admin/publishers') }}">
                <i class="mdi mdi-hexagon-multiple menu-icon"></i>
                <span class="menu-title">Publishers</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="mdi mdi-account-multiple menu-icon"></i>
                <span class="menu-title">Users</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/login-2.html"> Login 2 </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/register-2.html"> Register 2 </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/lock-screen.html"> Lockscreen </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item {{ Request::is('admin/sliders') ? 'active' : '' }}">
            <a class="nav-link" href="documentation/documentation.html">
                <i class="mdi mdi-view-carousel menu-icon"></i>
                <span class="menu-title">Home Slider</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('admin/settings') ? 'active' : '' }}">
            <a class="nav-link" href="pages/charts/chartjs.html">
                <i class="mdi mdi-settings menu-icon"></i>
                <span class="menu-title">Site Settings</span>
            </a>
        </li>
    </ul>
</nav>
