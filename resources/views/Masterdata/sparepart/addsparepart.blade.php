@extends('layouts.mainlayout')

@section('title', 'Add-sparepart')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah Sparepart</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Contact us</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content center">
            <form action="{{ route('sparepart_proses') }}" method="POST">
                @csrf
                <div class="d-flex justify-content-center">

                    <div class="card card-primary card-outline col-12 col-md-10">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-edit"></i>
                                Tx add sparepart
                            </h3>
                        </div>
                        <div class="card-body pad table-responsive">
                            @if (session('success'))
                                <div id="success-alert" class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div id="myAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error!</strong> Terdapat beberapa masalah dalam pengisian formulir:
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>

                                </div>


                            @endif

                            <div class="row pb-2">
                                <div class="col-md-4">
                                    <label for="nama_barang">Tgl PO</label>
                                    <input type="date" class="form-control" name="nama_barang"
                                        value="{{ old('nama_barang') }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="qty">No PO</label>
                                    <input type="text" class="form-control" name="qty" value="{{ old('qty') }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="harga_terbaru">Supplier</label>
                                    <input type="text" class="form-control" name="harga_terbaru"
                                        value="{{ old('harga_terbaru') }}">
                                </div>
                                <div class="col-md-2 d-flex flex-column">
                                    <div class="mt-auto">
                                        <button class="btn btn-primary tambah-item-btn">Tambah Supplier</button>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center">
                                <span class="text-white fw-bold fs-10">Rincian Barang</span>
                            </div>



                            <input type="hidden" class="form-control w-50" id="id_cabang" name="id_cabang"
                                value="{{ $cabang }}">
                            <table class="table table-bordered text-center pb-2">
                                <tr>

                                    <th>Nama Barang
                                        <a href="#myModalsparepart" data-toggle="modal" data-toggle="tooltip"
                                            title="Tambah sparepart" class="circle float-right">+</a>

                                    </th>
                                    <th>qty</th>
                                    <th>Harga</th>
                                    <th>Total Harga</th>
                                    <th>
                                        <bold>+/-</bold>
                                    </th>
                                </tr>
                                <tr>

                                    <td style="width: 35%;">
                                        <select class="form-control select2" id="nama_sparepart" name="nama_sparepart"
                                            style="width: 100%;">
                                            <option value="">Pilih Sparepart</option>
                                            @foreach ($sparepart as $part)
                                                <option value="{{ $part->id }}"
                                                    @if (old('nama_part') == $part->id) selected @endif>
                                                    {{ $part->nama_sparepart }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td style="width: 100px;">
                                        <input type="text" class="form-control" name="qty"
                                            value="{{ old('qty') }}">
                                    </td>

                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="harga" id="harga"
                                                name="harga">
                                        </div>

                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="nama_barang"
                                            value="{{ old('nama_barang') }}" disabled>
                                    </td>
                                    <td>
                                        <button class="btn btn-transparent"><i class="fas fa-plus text-primary"></i>
                                        </button>


                                    </td>
                                </tr>

                            </table>
                        </div>
                        <!-- /.card -->
                        <div class="form-group">
                            <div class="card-footer">
                                <input type="button" class="btn btn-secondary float-start" value="Cancel"
                                    onclick="window.history.back();">

                                <input type="submit" class="btn btn-primary float-end" value="Tambah">
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.col -->
            </form>
            @include('Masterdata.modal.modaladdsparepart')
    </div>
    {{-- @include('Masterdata.modal.modaladdtype') --}}

    </section>

    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- /.content -->

@endsection
