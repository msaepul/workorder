@extends('layouts.mainlayout')


@section('title', 'Data Order')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Work Order Cabang {{ cabangs($users->cabang) }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">DataTables</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">


                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('Workorder_create') }}" class="btn btn-primary"> <i
                                        class="nav-icon fas fa-plus"></i> Buat WO</a>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No WO</th>
                                            <th>Jenis WO</th>
                                            <th>Obyek</th>
                                            <th>Kendala</th>
                                            <th>WO dibuat</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($workorders as $wo)
                                            <tr>
                                                <td>{{ $wo->no_wo }}</td>
                                                <td>{{ $wo->kategori_wo }}
                                                </td>
                                                <td>{{ $wo->obyek }}</td>
                                                <td>{{ $wo->keadaan }}</td>
                                                <td>{{ $wo->wo_create }}</td>
                                                <td>{{ $wo->status }}</td>
                                                <td>X</td>
                                            </tr>
                                        @endforeach

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
