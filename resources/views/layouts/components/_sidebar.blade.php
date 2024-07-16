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

            @can('access-admin')
                <!-- Heading -->
                <div class="sidebar-heading">
                    {{ __('Admin') }}
                </div>

                <!-- Nav Item - User -->
                <li class="nav-item {{ Nav::isRoute('user_role.index') }}">
                    <a class="nav-link" href="{{ route('user_role.index') }}">
                        <i class="fas fa-fw fa-hands-helping"></i>
                        <span>{{ __('Manajemen User') }}</span>
                    </a>
                </li>
            @endcan

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Heading -->
            <div class="sidebar-heading">
                {{ __('Laporan') }}
            </div>

            <!-- Nav Item - About -->
            <li class="nav-item ">
                <a class="nav-link" href="">
                    <i class="fas fa-fw fa-hands-helping"></i>
                    <span>{{ __('Laporan Aset') }}</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            @canany(['access-admin', 'access-kepala-dinas'])
                <!-- Heading -->
                <div class="sidebar-heading">
                    {{ __('Manajemen Aset') }}
                </div>


                <!-- Nav Item - Aset -->
                <li class="nav-item {{ Nav::isRoute('aset.index') }}">
                    <a class="nav-link" href="{{ route('aset.index') }}">
                        <i class="fas fa-fw fa-user"></i>
                        <span>{{ __('Aset') }}</span>
                    </a>
                </li>
                <!-- Nav Item - Kategori Aset -->
                <li class="nav-item {{ Nav::isRoute('kategori_aset.index') }}">
                    <a class="nav-link" href="{{ route('kategori_aset.index') }}">
                        <i class="fas fa-fw fa-hands-helping"></i>
                        <span>{{ __('Kategori Aset') }}</span>
                    </a>
                </li>
                <!-- Nav Item - Supplier -->
                <li class="nav-item {{ Nav::isRoute('supplier.index') }}">
                    <a class="nav-link" href="{{ route('supplier.index') }}">
                        <i class="fas fa-fw fa-hands-helping"></i>
                        <span>{{ __('Supplier') }}</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">
            @endcanany

            <!-- Heading -->
            <div class="sidebar-heading">
                {{ __('Pengadaan Aset') }}
            </div>

            @can('access-pegawai')
                <!-- Nav Item - Pengajuan Aset -->
                <li class="nav-item {{ Nav::isRoute('pengajuan_aset.index') }}">
                    <a class="nav-link" href="{{ route('pengajuan_aset.index') }}">
                        <i class="fas fa-fw fa-hands-helping"></i>
                        <span>{{ __('Mengajukan Aset Baru') }}</span>
                    </a>
                </li>

                <!-- Nav Item - Pelaporan Aset Rusak -->
                <li class="nav-item {{ Nav::isRoute('pelaporan_aset_rusak.index') }}">
                    <a class="nav-link" href="{{ route('pelaporan_aset_rusak.index') }}">
                        <i class="fas fa-fw fa-hands-helping"></i>
                        <span>{{ __('Pelaporan Aset Rusak') }}</span>
                    </a>
                </li>
            @endcan

            @canany(['access-admin', 'access-kepala-dinas'])
                <!-- Nav Item - Pengesahan Aset -->
                <li class="nav-item {{ Nav::isRoute('pengesahan_aset.index') }}">
                    <a class="nav-link" href="{{ route('pengesahan_aset.index') }}">
                        <i class="fas fa-fw fa-hands-helping"></i>
                        <span>{{ __('Review Aset') }}</span>
                    </a>
                </li>
            @endcanany

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
