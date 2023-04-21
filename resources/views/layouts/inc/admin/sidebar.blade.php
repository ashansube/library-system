<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('admin/dashboard') }}">
                <i class="mdi mdi-speedometer menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('admin/cartorders') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('admin/cartorders') }}">
                <i class="mdi mdi-shopping menu-icon"></i>
                <span class="menu-title">Book Stall Orders</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('admin/readlistorders') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('admin/readlistorders') }}">
                <i class="mdi mdi-book-multiple menu-icon"></i>
                <span class="menu-title">Read List Orders</span>
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
        <li class="nav-item {{ Request::is('admin/users*') ? 'active' : '' }}">
            <a class="nav-link" data-bs-toggle="collapse" href="#users"
                aria-expanded="{{ Request::is('admin/users*') ? 'true' : 'false' }}">
                <i class="mdi mdi-account-multiple menu-icon"></i>
                <span class="menu-title">Users</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ Request::is('admin/users*') ? 'show' : '' }}" id="users">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin/users') || Request::is('admin/users/*/edit') ? 'active' : '' }}"
                            href="{{ url('admin/users') }}"> View Users </a>
                    </li>
                    {{-- <li class="nav-item"> <a class="nav-link" href="pages/samples/login-2.html"> Login 2 </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/register-2.html"> Register 2 </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/lock-screen.html"> Lockscreen </a> --}}
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item {{ Request::is('admin/sliders') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('admin/sliders') }}">
                <i class="mdi mdi-view-carousel menu-icon"></i>
                <span class="menu-title">Home Slider</span>
            </a>
        </li>
    </ul>
</nav>
