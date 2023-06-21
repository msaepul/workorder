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
                            MASTER DATA PERANGKAT
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
                                <a href="{{ route('add_sparepart') }}" type="button" class="btn btn-danger"
                                    style="margin-right: 3px;">
                                    <i class="nav-icon fas fa-pencil-alt"></i> Cek in/out
                                </a>
                                <a href="{{ route('add_sparepart') }}" type="button" class="btn btn-primary"
                                    style="margin-left: 3px;">
                                    <i class="nav-icon fas fa-plus"></i> Tambah Sparepart
                                </a>
                            </div>




                            {{-- @include('Masterdata.perangkat.modaladdperangkat') --}}

                            <!-- /.card-header -->
                            <div class="card-body">
                                @if (session('success'))
                                    <div id="success-alert" class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <script>
                                    setTimeout(function() {
                                        document.getElementById('success-alert').style.display = 'none';
                                    }, 5000);
                                </script>

                                <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Sparepart</th>

                                            <th>Supplier</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Total Harga</th>
                                            <th>Pembelian Terakhir</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sparepart as $key => $part)
                                            <tr>
                                                <td> {{ $loop->iteration }} </td>
                                                <td>{{ $part->nama_sparepart }}</td>

                                                <td>{{ $part->supplier }}</td>
                                                <td>{{ 'Rp ' . number_format($part->harga) }}</td>
                                                <td>{{ $part->stok }}</td>
                                                <td>{{ 'Rp ' . number_format($results[$key]) }}</td>

                                                <td>{{ $part->tgl_pbl }}</td>

                                                <td>

                                                    <form action="">

                                                        <input type="hidden" name="status" id="status">
                                                        <!-- Tombol Secondary -->
                                                        <button type="submit" class="btn btn-danger">Hapus</button>

                                                    </form>

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
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <!-- /.content-wrapper -->
@endsection
