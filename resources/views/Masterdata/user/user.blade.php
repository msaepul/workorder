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
                            MASTER DATA USER
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
                                <a href="{{ route('tambah_user') }}" type="button" class="btn btn-primary">
                                    <i class="nav-icon fas fa-plus"></i> Tambah Pengguna
                                </a>

                            </div>


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
                                                <td class="text-center">
                                                    <a href="{{ route('edit_user', ['id' => $user->id]) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="nav-icon fas fa-pen"></i> Edit
                                                    </a>
                                                    <form action="{{ route('user.destroy', ['id' => $user->id]) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this user?')">
                                                            <i class="nav-icon fas fa-trash"></i> Hapus
                                                        </button>
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
