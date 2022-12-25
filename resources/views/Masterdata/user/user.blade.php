@extends('layouts.main2layout')
@extends('layouts.side')

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
                            <li class="breadcrumb-item"><a href="Admin">Home</a></li>
                            <li class="breadcrumb-item active">Master Data User</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-user">
                                <i class="nav-icon fas fa-plus"></i> Buat User
                            </button>
                        </div>
                        @include('Masterdata.user.modaladduser')
                    </div>
         
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
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
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->nama_lengkap }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->cabang->cabang }}</td>
                                        <td>{{ $user->departemen->departemen }}</td>
                                        <td> <button type="button" class="btn btn-success" data-toggle="modal"
                                                data-target="#modal-edit{{$user->id}}">
                                                <i class="nav-icon fas fa-pen"></i>Edit
                                            </button> <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#modal-delete{{$user->id}}">
                                                <i class="nav-icon fas fa-trash"></i> hapus
                                            </button></td>
                                            @include('Masterdata.user.modaledit')
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

    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
