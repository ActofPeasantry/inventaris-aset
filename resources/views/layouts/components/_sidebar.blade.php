        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/home') }}">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('assets/logo_tanah_datar.png') }}" alt="" height="60" width="60">
                </div>
                <div class="sidebar-brand-text mx-3">Simanaset DPK</div>
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
                {{ __('Manajemen Aset') }}
            </div>

            <!-- Nav Item - Kategori Aset -->
            <li class="nav-item {{ Nav::isRoute('kategori_aset.index') }}">
                <a class="nav-link" href="{{ route('kategori_aset.index') }}">
                    <i class="fas fa-fw fa-hands-helping"></i>
                    <span>{{ __('Kategori Aset') }}</span>
                </a>
            </li>

            <!-- Nav Item - Aset -->
            <li class="nav-item {{ Nav::isRoute('aset.index') }}">
                <a class="nav-link" href="{{ route('aset.index') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>{{ __('Aset') }}</span>
                </a>
            </li>


            <!-- Nav Item - Supplier -->
            <li class="nav-item {{ Nav::isRoute('supplier.index') }}">
                <a class="nav-link" href="{{ route('supplier.index') }}">
                    <i class="fas fa-fw fa-hands-helping"></i>
                    <span>{{ __('Supplier') }}</span>
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
                {{ __('Pelaporan Aset') }}
            </div>

            <!-- Nav Item - Pengajuan Aset -->
            <li class="nav-item {{ Nav::isRoute('pengajuan_aset.index') }}">
                <a class="nav-link" href="{{ route('pengajuan_aset.index') }}">
                    <i class="fas fa-fw fa-hands-helping"></i>
                    <span>{{ __('Pengajuan Aset') }}</span>
                </a>
            </li>

            <!-- Nav Item - Pelaporan Aset Rusak -->
            <li class="nav-item {{ Nav::isRoute('pelaporan_aset_rusak.index') }}">
                <a class="nav-link" href="{{ route('pelaporan_aset_rusak.index') }}">
                    <i class="fas fa-fw fa-hands-helping"></i>
                    <span>{{ __('Pelaporan Aset Rusak') }}</span>
                </a>
            </li>

            <!-- Nav Item - Pengesahan Aset -->
            <li class="nav-item {{ Nav::isRoute('pengesahan_aset.index') }}">
                <a class="nav-link" href="{{ route('pengesahan_aset.index') }}">
                    <i class="fas fa-fw fa-hands-helping"></i>
                    <span>{{ __('Pengesahan Aset') }}</span>
                </a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Heading -->
            <div class="sidebar-heading">
                {{ __('Manajemen User') }}
            </div>

            <!-- Nav Item - User -->
            <li class="nav-item {{ Nav::isRoute('user_role.index') }}">
                <a class="nav-link" href="{{ route('user_role.index') }}">
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
