<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="Dashboard" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">

        <span class="brand-text font-weight-light">SO EDP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->nama_lengkap }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-header">MENU UTAMA</li>

                <li class="nav-item menu-open">
                    <a href="{{ route('dashboard') }}"
                        @if (request()->route()->uri == 'Dashboard') class="nav-link active"
     
            @else
            class="nav-link " @endif>
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('Workorder_create') }}"
                        @if (request()->route()->uri == 'Workorder') class="nav-link active"
     
              @else
              class="nav-link " @endif>
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Buat Work Order
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('Dataworkorder') }}"
                        @if (request()->route()->uri == 'datawo') class="nav-link active"
              @else
              class="nav-link " @endif>
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>
                            Work Order
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            TPM
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="TPMRingan"
                                @if (request()->route()->uri == 'TPMRingan') class="nav-link active"
                  @else
                  class="nav-link " @endif>
                                <i class="far fa-circle nav-icon "></i>
                                <p>TPM Ringan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a
                                href="TPMBerat"@if (request()->route()->uri == 'TPMBerat') class="nav-link active"
                  @else
                  class="nav-link " @endif>
                                <i class="far fa-circle nav-icon"></i>
                                <p>TPM Berat</p>
                            </a>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="JadwalTPM"
                        @if (request()->route()->uri == 'JadwalTPM') class="nav-link active"
              @else
              class="nav-link " @endif>
                        <i class="nav-icon fas fa-calendar-check"></i>
                        <p>
                            Jadwal TPM
                        </p>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="Gallery"
                        @if (request()->route()->uri == 'Gallery') class="nav-link active"
              @else
              class="nav-link " @endif>
                        <i class="nav-icon fas fa-images"></i>
                        <p>
                            Galeri

                        </p>
                    </a>

                </li>
                @if (Auth::user()->dept == 'EDP')
                    <li class="nav-header">MASTER DATA</li>

                    <li class="nav-item">
                        <a href="user"
                            @if (request()->route()->uri == 'user') class="nav-link active"
              @else
              class="nav-link " @endif>
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                User
                            </p>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fas fa-tree"></i>
                            <p>
                                Asset
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item ">
                                <a href="TPMRingan"
                                    @if (request()->route()->uri == 'TPMRingan') class="nav-link active"
                      @else
                      class="nav-link " @endif>
                                    <i class="far fa-circle nav-icon "></i>
                                    <p>TPM Ringan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a
                                    href="TPMBerat"@if (request()->route()->uri == 'TPMBerat') class="nav-link active"
                      @else
                      class="nav-link " @endif>
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>TPM Berat</p>
                                </a>

                        </ul>
                    </li> --}}
                    <li class="nav-item">
                        <a href="{{ route('perangkat') }}"
                            @if (request()->route()->uri == 'perangkat') class="nav-link active"
                            @elseif (request()->route()->uri == 'tambah-perangkat') class="nav-link active"
                               @else class="nav-link " @endif>
                            <i class="nav-icon fas fa-laptop"></i>
                            <p>
                                Asset
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('sparepart') }}"
                            @if (request()->route()->uri == 'sparepart') class="nav-link active"
              @else
              class="nav-link " @endif>
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Sparepart
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-header">LAPORAN</li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>
                            Work Order
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/mailbox/mailbox.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inbox</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/mailbox/compose.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Compose</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/mailbox/read-mail.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Read</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            TPM
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
