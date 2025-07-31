<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        {{-- <div class="sidebar-brand-icon rotate-n-15">
        </div> --}}
        <div class="sidebar-brand-text mx-3">REKAM MEDIS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    @if(auth()->user()->role === 'admin')
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
        aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Manajemen Data</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Manajemen Data</h6>
            <a class="collapse-item {{ set_active(['user.index','user.edit']) }}"
                href="{{ route('user.index') }}">Data Akun User</a>
        </div>
    </div>
    </li>
    @endif

    <li class="nav-item {{ set_active(['pelanggan.keluh']) }}">
    <a class="nav-link" href="{{ route('pelanggan.keluh') }}">
        <i class="fas fa-fw fa-car"></i>
        <span>Keluhan</span>
    </a>
    </li>

    <li class="nav-item {{ set_active(['rekammedis.index']) }}">
    <a class="nav-link" href="{{ route('rekammedis.index') }}">
        <i class="fas fa-fw fa-car"></i>
        <span>Rekam Medis</span>
    </a>
    </li>
    <li class="nav-item {{ set_active(['pelanggan.index']) }}">
    <a class="nav-link" href="{{ route('pelanggan.index') }}">
        <i class="fas fa-fw fa-users"></i>
        <span>Pelanggan</span>
    </a>
    </li>

    <li class="nav-item {{ set_active(['rekam_detail_part.index']) }}">
    <a class="nav-link" href="{{ route('rekam_detail_part.index') }}">
        <i class="fas fa-fw fa-check"></i>
        <span>Verifikasi Pekerjaan</span>
    </a>
    </li>

    <li class="nav-item {{ set_active(['rekam_detail_part.index']) }}">
    <a class="nav-link" href="{{ route('rekam_detail_part.index') }}">
        <i class="fas fa-fw fa-tools"></i>
        <span>Detail Part</span>
    </a>
</li>
<li class="nav-item {{ set_active(['suku_cadang.index']) }}">
    <a class="nav-link" href="{{ route('suku_cadang.index') }}">
        <i class="fas fa-fw fa-cog"></i>
        <span>Suku Cadang</span>
    </a>
</li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->