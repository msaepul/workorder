@extends('layouts.mainlayout')

@section('title', 'Master Data Perangkat')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>

                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Modals & Alerts</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header ">
                                <center>
                                    <h5><b>DATA WORK ORDER CABANG</b></h5>
                                </center>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                @if (session('success'))
                                    <div id="success-alert" class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No WO</th>
                                            <th>Jenis WO</th>
                                            <th>Obyek</th>
                                            <th>Kendala</th>
                                            <th>WO dibuat</th>
                                            <th>Status</th>
                                            <th>Dibuat oleh</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($workorders as $wo)
                                            <tr>
                                                <td class="text-center">{{ $wo->no_wo }}</td>
                                                <td class="text-center">{{ $wo->kategori_wo }}
                                                </td>
                                                <td>{{ $wo->obyek }}</td>
                                                <td>{{ $wo->keadaan }}</td>
                                                <td class="text-center">{{ $wo->wo_create }}</td>
                                                <td class="text-center">
                                                    @if ($wo->status == 0)
                                                        <button class="btn btn-danger btn-xs">Cancel</button>
                                                    @elseif ($wo->status == 1)
                                                        <button class="btn btn-secondary btn-xs">Draft</button>
                                                    @elseif ($wo->status == 2)
                                                        <button class="btn btn-primary btn-xs">Confirm</button>
                                                    @elseif ($wo->status == 3 || $wo->status == 4)
                                                        <button class="btn btn-warning btn-xs">On Progress</button>
                                                    @elseif ($wo->status == 5)
                                                        <button class="btn btn-success btn-xs">Done</button>
                                                    @endif


                                                </td>

                                                <td class="text-center">{{ getFullName($wo->user_id) }}</td>
                                                <td class="text-center"> <a href="{{ route('Workorder_detail', $wo->id) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                            </div>
                            <!-- /.card-body -->

                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <!-- /.content -->
    </div>
    <script src="plugins/jquery/jquery.min.js"></script>
    {{-- <script>
        $(document).ready(function() {
            $('#example2').DataTable({
                autoWidth: true,
                responsive: true,
                pageLength: 10, // Menampilkan 10 baris per halaman
                dom: 'Bfrtip',
            });
        });
    </script> --}}
    <script>
        $(document).ready(function() {
            $('#example1').DataTable();
        });
    </script>
    <!-- /.content-wrapper -->
@endsection
