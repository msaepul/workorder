<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIEDP | @yield('title')</title>
    <link rel="icon" href="{{ asset('dist/img/arnonlogo.png') }}" type="image/png">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap4.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar/main.css') }}" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="path/to/magnific-popup.css">
    <style>
        .gradient-custom {
            /* fallback for old browsers */
            background: #f6d365;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
        }
    </style>
    <style>
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);

        }

        .lampiran-wrapper {
            position: relative;
            display: inline-block;
        }

        .hapus-lampiran {
            position: absolute;
            top: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            padding: 4px 8px;
            font-size: 12px;
            cursor: pointer;
        }
    </style>


    <style>
        .circle {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #ff0000;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: bold;
        }

        .circle:hover {
            background-color: #0056b3;
        }

        .tooltip {
            background-color: #000;
            color: #fff;
            padding: 8px;
            border-radius: 4px;
            font-size: 14px;
        }

        .card-body-a {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            height: 60px;
        }

        .status-container {
            display: flex;
            align-items: center;
        }

        .box {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 120px;
            height: 30px;
            color: #ffffff;
            background-color: gray;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            /* Menambahkan efek shadow */
            border-radius: 5px;
            /* Melenkung elemen */
            transform: perspective(200px) rotateX(5deg);
            /* Memberikan efek 3D dengan rotasi pada sumbu X */
        }

        .box2 {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 120px;
            height: 20px;
            color: #ffffff;
            background-color: gray;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            /* Menambahkan efek shadow */
            border-radius: 5px;
            /* Melenkung elemen */
            transform: perspective(200px) rotateX(5deg);
            /* Memberikan efek 3D dengan rotasi pada sumbu X */
        }

        .status {
            font-size: 12px;
        }

        .arrow {
            width: 10px;
            height: 10px;
            border-top: 3px solid gray;
            border-right: 3px solid gray;
            transform: rotate(45deg);
            margin-left: 5px;
            margin-right: 5px;
            /* Tambahkan margin-right di sini */
        }


        .card-body-a {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .left-links {
            display: flex;
            align-items: center;
        }

        .right-status {
            display: flex;
            align-items: center;
        }

        .disabled-input {
            background-color: #ffffff;
            /* Atur warna latar belakang */
            color: #696767;
            /* Atur warna teks */
            cursor: not-allowed;
            /* Atur kursor saat diarahkan ke elemen */
        }

        .gambar-kecil {
            max-width: 300px;
            max-height: 200px;
        }

        /* Your custom CSS file */
        .close-white {
            color: #fff !important;
            /* Use !important to override any conflicting styles */
        }
    </style>
</head>


<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
                height="120">

        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>


                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user bold"></i>

                    </a>
                    <div class="dropdown-menu dropdown-menu dropdown-menu-right">

                        <div class="dropdown-divider"></div>
                        <a href="{{ route('profile') }}" class="dropdown-item">
                            <i class="fas fa-User mr-2"></i> Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-gear mr-2"></i> Setting
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}" class="dropdown-item">
                                <i class="fas fa-sign-out mr-2"></i>Logout

                            </a>

                    </div>
                </li>
                {{-- <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> --}}

        </nav>
        <!-- /.navbar -->
        @include('layouts.side')
        @yield('content')

        {{-- Modal --}}
        <div id="exportwo" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h4 class="modal-title">REKAP WORK ORDER </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form method="GET" id="insert_form" action="{{ route('exportWOCabang') }}">
                            <label>Pilih Cabang </label>
                            <select name="cabang" id="cabang" class="form-control" required>
                                <option style="opacity: 10%;" value="" selected disabled>....</option>
                                <option value="101" @if (cabang() != 'HO' && cabang() != 'PDL') hidden @endif required>PDL
                                </option>
                                <option value="102" @if (cabang() != 'HO' && cabang() != 'TGL') hidden @endif required>TGL
                                </option>
                                <option value="103" @if (cabang() != 'HO' && cabang() != 'MDO') hidden @endif required>MDO
                                </option>
                                <option value="104" @if (cabang() != 'HO' && cabang() != 'MKS') hidden @endif required>MKS
                                </option>
                                <option value="105" @if (cabang() != 'HO' && cabang() != 'KDR') hidden @endif required>KDR
                                </option>
                                <option value="106" @if (cabang() != 'HO' && cabang() != 'BDJ') hidden @endif required>BDJ
                                </option>
                                <option value="107" @if (cabang() != 'HO' && cabang() != 'BWI') hidden @endif required>BWI
                                </option>
                                <option value="108" @if (cabang() != 'HO' && cabang() != 'LPG') hidden @endif required>LPG
                                </option>
                                <option value="109" @if (cabang() != 'HO' && cabang() != 'DMK') hidden @endif required>DMK
                                </option>
                                <option value="110" @if (cabang() != 'HO' && cabang() != 'PLM') hidden @endif required>PLM
                                </option>
                                <option value="111" @if (cabang() != 'HO' && cabang() != 'BLI') hidden @endif required>BLI
                                </option>
                                <option value="112" @if (cabang() != 'HO' && cabang() != 'PKU') hidden @endif required>PKU
                                </option>
                                <option value="116" @if (cabang() != 'HO' && cabang() != 'MDN') hidden @endif required>MDN
                                </option>
                                <option value="117" @if (cabang() != 'HO' && cabang() != 'LOM') hidden @endif required>LOM
                                </option>
                                <option value="118" @if (cabang() != 'HO' && cabang() != 'PNK') hidden @endif required>PNK
                                </option>
                                <option value="119" @if (cabang() != 'HO' && cabang() != 'LLG') hidden @endif required>LLG
                                </option>
                                <option value="121" @if (cabang() != 'HO' && cabang() != 'CBL') hidden @endif required>CBL
                                </option>
                                <option value="122" @if (cabang() != 'HO' && cabang() != 'JTW') hidden @endif required>JTW
                                </option>
                                <option value="123" @if (cabang() != 'HO' && cabang() != 'PLU') hidden @endif required>PLU
                                </option>
                                <option value="124" @if (cabang() != 'HO' && cabang() != 'AMQ') hidden @endif required>AMQ
                                </option>
                                <option value="125" @if (cabang() != 'HO' && cabang() != 'KDI') hidden @endif required>KDI
                                </option>
                            </select>
                            <label>Pilih Bulan</label>


                            <select name="bulan" id="bulan" class="form-control" required>

                                <option value="{{ now()->format('m') }}" selected disabled>.....</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}"
                                        @if ($i == now()->month) selected @endif>
                                        {{ \Carbon\Carbon::create(null, $i, 1)->format('F') }}
                                    </option>
                                @endfor

                            </select>
                            <label>Pilih Tahun</label>
                            <select name="tahun" id="tahun" class="form-control" required>

                                <option value="{{ now()->year }}" selected disabled>.....</option>
                                @for ($year = now()->year; $year >= 2022; $year--)
                                    <option value="{{ $year }}"
                                        @if ($year == now()->year) selected @endif>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                            {{-- <label>Pilih Work Order</label>
                            <select name="jenis" id="jenis" class="form-control" required>
                                <option value="1">Work Order On progress</option>
                            </select> --}}
                            <br>

                    </div>
                    <div class="modal-footer text-center">
                        <input type="submit" name="insert" id="insert" value="Export Data"
                            class="btn btn-success" />
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer><!-- ./wrapper -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <!-- jQuery -->
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.2/js/dataTables.bootstrap4.min.js"></script>

        <!-- Select2 -->
        <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>

        <!-- Data Tables -->
        <script src="{{ asset('/') }}plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="{{ asset('/') }}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

        {{-- <script src="{{ asset('/') }}plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="{{ asset('/') }}plugins/select2/js/select2.full.min.js"></script> --}}
        <!-- AdminLTE App -->
        <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

        {{-- calender --}}
        <!-- /.content-wrapper -->
        <!-- fullCalendar 2.2.5 -->
        <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
        <script src="{{ asset('plugins/fullcalendar/main.js') }}"></script>
        <script>
            function disableperangkat(that) {
                console.log(that.value);
                if (that.value == "hardware") {
                    document.getElementById("jenis").disabled = false;

                } else {
                    document.getElementById("jenis").disabled = true;
                }
            }
        </script>
        <script>
            $(function() {
                bsCustomFileInput.init();
            });
        </script>

        <script>
            $(function() {
                //Initialize Select2 Elements
                $('.select2').select2()

                //Initialize Select2 Elements
                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                })
            });
        </script>
        <script>
            // Menghilangkan pesan alert setelah 5 detik
            setTimeout(function() {
                document.getElementById('myAlert').remove();
            }, 10000);
        </script>

        <script>
            setTimeout(function() {
                document.getElementById('success-alert').style.display = 'none';
            }, 5000);
        </script>


</body>

</html>
