<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2" style="overflow-y: auto; overflow-x: hidden; max-height: 80vh;">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('users.index') }}"
                    class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        {{ __('Users') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('truks.index') }}"
                    class="nav-link {{ request()->routeIs('truks.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-truck"></i>
                    <p>
                        {{ __('Truk') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('supirs.index') }}"
                    class="nav-link {{ request()->routeIs('supirs.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user-tie"></i>
                    <p>
                        {{ __('Supir') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('presentases.index') }}"
                    class="nav-link {{ request()->routeIs('presentases.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-percentage"></i>
                    <p>
                        {{ __('Presentase') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('penjuals.index') }}"
                    class="nav-link {{ request()->routeIs('penjuals.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-store"></i>
                    <p>
                        {{ __('Penjual') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('sortirs.index') }}"
                    class="nav-link {{ request()->routeIs('sortirs.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-sort"></i>
                    <p>
                        {{ __('Sortir Sawit') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('riwayat_sortirs.index') }}"
                    class="nav-link {{ request()->routeIs('riwayat_sortirs.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-history"></i>
                    <p>Riwayat Sortir Sawit</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('transaksis.create') }}"
                    class="nav-link {{ request()->routeIs('transaksis.create') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-shopping-cart"></i>
                    <p>Transaksi</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('transaksis.report') }}"
                    class="nav-link {{ request()->routeIs('transaksis.report') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-file-alt"></i>
                    <p>Laporan Transaksi</p>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle nav-icon"></i>
                    <p>
                        WOKWOK
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Child menu</p>
                        </a>
                    </li>
                </ul>
            </li> --}}
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
