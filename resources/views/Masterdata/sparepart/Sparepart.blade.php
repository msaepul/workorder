@extends('layouts.mainlayout')

@section('title', 'Data Sparepart')

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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Data Sparepart</li>
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

                                <a href="{{ route('add_sparepart') }}" type="button" class="btn btn-success"
                                    style="margin-left: 3px;">
                                    <i class="nav-icon fas fa-plus"></i> Sparepart IN
                                </a>

                                <a href="{{ route('out_sparepart') }}" type="button" class="btn btn-danger"
                                    style="margin-left: 3px;">
                                    <i class="nav-icon fas fa-minus"></i> Sparepart Out
                                </a>
                            </div>




                            {{-- @include('Masterdata.modal.modalinout') --}}

                            <!-- /.card-header -->
                            <div class="card-body">
                                @if (session('success'))
                                    <div id="success-alert" class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <table id="example1" class="table table-bordered table-striped">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Sparepart</th>
                                            <th>Supplier</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Total Harga</th>
                                            <th>Pembelian Terakhir</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($sparepart as $key => $part)
                                            <tr>
                                                <td class="text-center"> {{ $loop->iteration }} </td>
                                                <td>{{ $part->nama_sparepart }}</td>

                                                <td class="text-center">{{ getSupplierName($part->supplier) }}</td>
                                                <td class="text-center">{{ 'Rp ' . number_format($part->harga) }}</td>
                                                <td class="text-center">{{ $part->stok }}</td>
                                                <td class="text-center">{{ 'Rp ' . number_format($results[$key]) }}</td>

                                                <td class="text-center">{{ $part->tgl_pbl }}</td>

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
