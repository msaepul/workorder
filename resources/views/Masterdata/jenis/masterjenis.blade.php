@extends('layouts.mainlayout')

@section('title', 'Master Data Jenis Perangkat')

@section('content')
    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            MASTER DATA JENIS PERANGKAT
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
                                <a href="#myModaljenis" data-toggle="modal" data-toggle="tooltip" title="Tambah jenis"
                                    class="btn btn-success">
                                    <i class="nav-icon fas fa-plus"></i> Tambah Data
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
                                    <thead>
                                        <tr>
                                            <th style="width: 10%" class="text-center">No</th>
                                            <th class="text-center">Nama jenis</th>
                                            <th style="width: 20%" class="text-center">Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jenis as $key => $j)
                                            <tr>
                                                <td class="text-center"> {{ $loop->iteration }} </td>
                                                <td>{{ $j->jenis_perangkat }}</td>
                                                <td>
                                                    {{-- <form action="{{ route('destroy_sparepart', $part->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-warning"> <i
                                                                class="nav-icon fas fa-pencil-alt"></i>permintaan</button>
                                                    </form> --}}
                                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target="#myModaleditjenis{{ $j->id }}">
                                                        <i class="fas fa-pencil-alt"></i> Edit
                                                    </button>



                                                    <form action="{{ route('destory_jenis', $j->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </button>
                                                    </form>

                                                </td>

                                            </tr>
                                            @include('Masterdata.modal.modaleditjenis')
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
            @include('Masterdata.modal.modaladdjenis')

        </section>
        <!-- Main content -->
        <!-- /.content -->
    </div>

    <script src="plugins/jquery/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example1').DataTable({
                autoWidth: true,
                responsive: true,
                pageLength: 10, // Menampilkan 10 baris per halaman
                dom: 'Bfrtip',
            });
        });
    </script>


    <!-- /.content-wrapper -->
@endsection
