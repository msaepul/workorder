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
                                <a href="{{ route('add_perangkat') }}" type="button" class="btn btn-primary">
                                    <i class="nav-icon fas fa-plus"></i> Tambah Perangkat
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

                                <table id="dari" class="table table-sm table-bordered table-striped user_datatable"
                                    style="text-align: center;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Inventaris</th>
                                            <th>Jenis Perangkat</th>
                                            <th>Spesifikasi</th>
                                            <th>Merk/Type</th>
                                            <th>pengguna</th>
                                            <th>Cabang</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($perangkat as $device)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><a href="{{ route('detail_perangkat', $device->id) }}"
                                                        style="color: black;">{{ $device->nama_perangkat }}</a></td>

                                                <td>{{ $device->jenis_perangkat }}</td>
                                                <td>{{ $device->spesifikasi }}</td>
                                                <td>{{ $device->brand_name }} / {{ $device->type_name }}</td>
                                                <td>{{ $device->user->nama_lengkap }}</td>
                                                <td>{{ $device->cabang_name }}</td>
                                                <td>{{ $device->status }}</td>
                                                <td>
                                                    <a href="{{ route('edit_perangkat', $device->id) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="nav-icon fas fa-pen"></i> Edit
                                                    </a>

                                                    <form action="{{ route('destroy_perangkat', $device->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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
    <script src="plugins/jquery/jquery.min.js"></script>
    <script>
        $(function() {
            $("#dari").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "order": [
                    [1, 'desc'],
                    [0, 'desc'],
                ],
                "columnDefs": [{
                        "orderable": false,
                        "targets": 8,
                    },

                ]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
    <!-- /.content-wrapper -->
@endsection
