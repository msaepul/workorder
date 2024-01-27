<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->




    <!-- Sidebar -->
    <div class="sidebar sidebar-dark-primary">


        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-center align-items-center">
            <div class="info">
                <img id="sidebar-logo" src="{{ asset('dist/img/arnonlogo.png') }}" alt="AdminLTE Logo" class=""
                    style=" width: 110px; height: 55px;">
            </div>
        </div>


        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">

                <a href="{{ route('profile') }}" class="d-block">{{ Auth::user()->nama_lengkap }}</a>
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

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        @if (request()->route()->uri == 'Dashboard') class="nav-link active"   @else
            class="nav-link " @endif>
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item  @if (request()->route()->getName() == 'Workorder_create' ||
                        request()->route()->getName() == 'Dataworkorder' ||
                        request()->route()->getName() == 'datawoall') menu-open @endif">
                    <a href="#" class="nav-link @if (request()->route()->getName() == 'Workorder_create' ||
                            request()->route()->getName() == 'Dataworkorder' ||
                            request()->route()->getName() == 'datawoall') active @endif ">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>
                            Work Order
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('Workorder_create') }}"
                                @if (request()->route()->getName() == 'Workorder_create') class="nav-link active"
                @else class="nav-link" @endif>
                                <i class="fas fa-ellipsis-h nav-icon"></i>
                                <p>
                                    Buat Work Order
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('Dataworkorder') }}"
                                @if (request()->route()->getName() == 'Dataworkorder') class="nav-link active"
                @else class="nav-link" @endif>
                                <i class="fas fa-ellipsis-h nav-icon"></i>
                                <p>
                                    Data Work Order
                                </p>
                            </a>
                        </li>
                        @if (Auth::user()->cabang == 100 && Auth::user()->dept == 'EDP')
                            <li class="nav-item">
                                <a href="{{ route('datawoall') }}"
                                    @if (request()->route()->getName() == 'datawoall') class="nav-link active"
                @else class="nav-link" @endif>
                                    <i class="fas fa-ellipsis-h nav-icon"></i>
                                    <p>
                                        Seluruh Data WOrk Order
                                    </p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>


                <li class="nav-item @if (request()->is('sparepart/request') || request()->is('sparepart') || request()->is('sparepart/history')) menu-open @endif">
                    <a href="#" class="nav-link @if (request()->is('sparepart/request') || request()->is('sparepart') || request()->is('sparepart/history')) active @endif">
                        <i class="fas fa-cogs nav-icon"></i>
                        <p>
                            Sparepart
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('request_sparepart') }}"
                                @if (request()->is('sparepart/request')) class="nav-link active" @else class="nav-link" @endif>
                                <i class="fas fa-ellipsis-h nav-icon"></i>

                                <p>
                                    Permintaan Sparepart
                                </p>
                            </a>
                        </li>
                        @if (Auth::user()->dept == 'EDP')
                            <li class="nav-item">
                                <a href="{{ route('sparepart') }}"
                                    @if (request()->is('sparepart')) class="nav-link active" @else class="nav-link" @endif>
                                    <i class="fas fa-ellipsis-h nav-icon"></i>

                                    <p>
                                        Stok Sparepart
                                    </p>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('history_sparepart') }}"
                                @if (request()->is('sparepart/history')) class="nav-link active" @else class="nav-link" @endif>
                                <i class="fas fa-ellipsis-h nav-icon"></i>

                                <p>
                                    History Permintaan
                                </p>
                            </a>
                        </li>

                    </ul>
                </li>
                @if (Auth::user()->dept == 'EDP')

                    <li class="nav-header">MANAGE PERANGKAT</li>

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

                    <li class="nav-header">MANAGE USER</li>


                    <li class="nav-item">
                        <a href="{{ route('user') }}"
                            @if (request()->route()->uri == 'user') class="nav-link active"
              @else
              class="nav-link " @endif>
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                User
                            </p>
                        </a>
                    </li>
                    @if (Auth::user()->cabang == 100)
                        <li class="nav-item">
                            <a href="{{ route('mastercabang') }}"
                                @if (request()->route()->uri == 'cabang') class="nav-link active"
              @else
              class="nav-link " @endif>
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Master Cabang
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('masterdepartemen') }}"
                                @if (request()->route()->uri == 'departemen') class="nav-link active"
              @else
              class="nav-link " @endif>
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Master Departemen
                                </p>
                            </a>
                        </li>
                    @endif
                    <li class="nav-header">MASTER DATA</li>

                    <li class="nav-item">
                        <a href="{{ route('mastersparepart') }}"
                            @if (request()->route()->uri == 'sparepart/master') class="nav-link active"
              @else
              class="nav-link " @endif>
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Master Sparepart
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('mastersupplier') }}"
                            @if (request()->route()->uri == 'supplier') class="nav-link active"
              @else
              class="nav-link " @endif>
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Master Supplier
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('masterbrand') }}"
                            @if (request()->route()->uri == 'brand') class="nav-link active"
              @else
              class="nav-link " @endif>
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Master Brand
                            </p>
                        </a>
                    </li>

                    @if (Auth::user()->cabang == 100)
                        <li class="nav-item">
                            <a href="{{ route('masterjenis') }}"
                                @if (request()->route()->uri == 'jenis') class="nav-link active"
              @else
              class="nav-link " @endif>
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Master Jenis Perangkat
                                </p>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{ route('mastertype') }}"
                            @if (request()->route()->uri == 'type') class="nav-link active"
              @else
              class="nav-link " @endif>
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Master Type Perangkat
                            </p>
                        </a>
                    </li>



                    <li class="nav-header">LAPORAN</li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tools"></i>
                            <p>
                                Work Order

                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<script>
    $(document).ready(function() {
        // Function to hide/show the image based on the sidebar state
        function updateLogoVisibility() {
            var isSidebarCollapsed = $('body').hasClass('sidebar-collapse');

            if (isSidebarCollapsed) {
                $('#sidebar-logo').addClass('d-none');
            } else {
                $('#sidebar-logo').removeClass('d-none');
            }
        }

        // Initial check on page load
        updateLogoVisibility();

        // Add an event listener for changes in the sidebar state
        $('body').on('collapsed.lte.pushmenu expanded.lte.pushmenu', function() {
            updateLogoVisibility();
        });
    });
</script>
