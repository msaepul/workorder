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
                        <div class="card-header">
                            <a href="tambah-perangkat" type="button" class="btn btn-primary" >
                                <i class="nav-icon fas fa-plus"></i> Tambah Perangkat
                            </a>

                        </div>
                        @include('Masterdata.perangkat.modaladdperangkat')
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Inventaris</th>
                                    <th>Jenis Perangkat</th>
                                    <th>Spesifikasi</th>
                                    <th>Merk/Type</th>
                                    <th>pengguna</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ( $perangkat as $device )

                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$device->no_inventaris}}</td>
                                    <td>{{$device->jenis_perangkat}}
                                    </td>
                                    <td>{{$device->spesifikasi}}</td>
                                    <td>{{$device->merk}}/{{$device->type}}</td>
                                    <td>{{$device->user_id}}</td>
                                    <td>{{$device->status}}</td>
                                    <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-perangkat">
                                            <i class="nav-icon fas fa-pen"></i>lihat
                                        </button> <button type="button" class="btn btn-danger" data-toggle="modal" data-target="">
                                            <i class="nav-icon fas fa-trash"></i> hapus
                                        </button></td>
                                    @endforeach
                                </tr>
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
<section class="content">
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Default Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>One fine body&hellip;</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

</section>
<!-- /.content -->
</div>
<script src="plugins/jquery/jquery.min.js"></script>
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