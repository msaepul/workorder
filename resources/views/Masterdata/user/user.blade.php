@extends('layouts.mainlayout')

@section('title', 'Master Data User')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            MASTER DATA User
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
                                <a href="tambah-perangkat" type="button" class="btn btn-primary">
                                    <i class="nav-icon fas fa-plus"></i> Tambah Perangkat
                                </a>

                            </div>
                            {{-- @include('Masterdata.perangkat.modaladdperangkat') --}}

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example" class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama Lengkap</th>
                                            <th>Username</th>
                                            <th>Cabang</th>
                                            <th>Departemen</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $user->nama_lengkap }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td class="text-center">{{ $user->cabang }}</td>
                                                <td class="text-center">{{ $user->dept }}</td>
                                                <td class="text-center"> <button type="button"
                                                        class="btn btn-sm btn-warning" data-toggle="modal"
                                                        data-target="#modal-edit{{ $user->id }}">
                                                        <i class="nav-icon fas fa-pen"></i>Edit
                                                    </button> <button type="button" class="btn btn-sm btn-danger"
                                                        data-toggle="modal" data-target="#modal-delete{{ $user->id }}">
                                                        <i class="nav-icon fas fa-trash"></i> hapus
                                                    </button>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                // 'ajax': 'https://gyrocode.github.io/files/jquery-datatables/arrays.json',
                'rowsGroup': [2]
            });
        });
    </script>


    <!-- /.content-wrapper -->
@endsection
