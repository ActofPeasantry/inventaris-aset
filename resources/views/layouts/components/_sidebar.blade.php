        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/home') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Nav::isRoute('home') }}">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>{{ __('Dashboard') }}</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                {{ __('Menu') }}
            </div>

            <!-- Nav Item - Kategori Aset -->
            <li class="nav-item {{ Nav::isRoute('kategori_aset.index') }}">
                <a class="nav-link" href="{{ route('kategori_aset.index') }}">
                    <i class="fas fa-fw fa-hands-helping"></i>
                    <span>{{ __('Kelola Kategori Aset') }}</span>
                </a>
            </li>

            <!-- Nav Item - Aset -->
            <li class="nav-item {{ Nav::isRoute('aset.index') }}">
                <a class="nav-link" href="{{ route('aset.index') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>{{ __('Kelola Aset') }}</span>
                </a>
            </li>


            <!-- Nav Item - Supplier -->
            <li class="nav-item {{ Nav::isRoute('supplier.index') }}">
                <a class="nav-link" href="{{ route('supplier.index') }}">
                    <i class="fas fa-fw fa-hands-helping"></i>
                    <span>{{ __('Kelola Supplier') }}</span>
                </a>
            </li>

            <!-- Nav Item - About -->
            <li class="nav-item {{ Nav::isRoute('about') }}">
                <a class="nav-link" href="{{ route('about') }}">
                    <i class="fas fa-fw fa-hands-helping"></i>
                    <span>{{ __('Laporan Aset') }}</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Heading -->
            <div class="sidebar-heading">
                {{ __('User Manajemen') }}
            </div>

            <!-- Nav Item - User -->
            <li class="nav-item {{ Nav::isRoute('about') }}">
                <a class="nav-link" href="{{ route('about') }}">
                    <i class="fas fa-fw fa-hands-helping"></i>
                    <span>{{ __('Users') }}</span>
                </a>
            </li>

            <!-- Nav Item - Roles -->
            <li class="nav-item {{ Nav::isRoute('about') }}">
                <a class="nav-link" href="{{ route('about') }}">
                    <i class="fas fa-fw fa-hands-helping"></i>
                    <span>{{ __('Roles') }}</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
