@extends('layouts.mainlayout')

@section('title', 'Master Data Sparepart')

@section('content')
    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            MASTER DATA Sparepart
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
                                <a href="#myModalsparepart" data-toggle="modal" data-toggle="tooltip"
                                    title="Tambah sparepart" class="btn btn-success">
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
                                            <th class="text-center">Nama Sparepart</th>
                                            <th style="width: 20%" class="text-center">Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sparepart as $key => $part)
                                            <tr>
                                                <td class="text-center"> {{ $loop->iteration }} </td>
                                                <td>{{ $part->nama_sparepart }}</td>
                                                <td class="text-center">
                                                    {{-- <form action="{{ route('destroy_sparepart', $part->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-warning"> <i
                                                                class="nav-icon fas fa-pencil-alt"></i>permintaan</button>
                                                    </form> --}}
                                                    <button type="button" class="btn btn-sm btn-warning"
                                                        data-toggle="modal"
                                                        data-target="#myModaleditsparepart{{ $part->id }}">
                                                        <i class="fas fa-pencil-alt"></i> Edit
                                                    </button>



                                                    <form action="{{ route('destroy_sparepart', $part->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </button>
                                                    </form>

                                                </td>

                                            </tr>
                                            @include('Masterdata.modal.modaleditsparepart')
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
            @include('Masterdata.modal.modaladdsparepart')

        </section>
        <!-- Main content -->
        <!-- /.content -->
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#example1').DataTable({
                // 'ajax': 'https://gyrocode.github.io/files/jquery-datatables/arrays.json',
                'rowsGroup': [2]
            });
        });
    </script>

    <!-- /.content-wrapper -->
@endsection
