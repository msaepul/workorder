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
                    <!-- Default box -->
                    <div class="card card-primary card-outline col-12 col-md-8">
                        <div class="card-body">
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


                            <div class="form-group row pb-2">
                                <div
                                    class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                    <label for="nama_sparepart" class="text-end">Nama sparepart</label>
                                </div>
                                <div class="col-12 col-md-7 col-sm-7">
                                    <input type="text" id="nama_sparepart" class="form-control" name="nama_sparepart"
                                        placeholder="Masukkan Nama Sparepart" value="{{ old('nama_sparepart') }}" />
                                </div>
                            </div>


                            <div class="form-group row pb-2 ">
                                <div
                                    class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                    <label for="tgl_pbl" class="text-end">Tanggal Pembelian</label>
                                </div>
                                <div class="col-12 col-sm-7">
                                    <input type="date" class="form-control w-50" id="tgl_pbl" name="tgl_pbl"
                                        value="{{ old('tgl_pbl') }}">
                                </div>
                            </div>
                            <div class="form-group row pb-2">
                                <div
                                    class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                    <label for="nopo" class="text-end">No PO</label>
                                </div>
                                <div class="col-12 col-sm-7">
                                    <input type="text" id="nopo" class="form-control" name="nopo"
                                        placeholder="Nomor PO" />
                                </div>
                            </div>
                            <div class="form-group row pb-2 ">
                                <div
                                    class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                    <label for="supplier" class="text-end">Supplier </label>
                                </div>
                                <div class="col-12 col-sm-7">
                                    <input type="text" id="supplier" class="form-control" name="supplier"
                                        placeholder="Supplier" value="{{ old('supplier') }}" />
                                </div>
                            </div>
                            <input type="hidden" class="form-control w-50" id="id_cabang" name="id_cabang"
                                value="{{ $cabang }}">
                            <div class="form-group row pb-2">

                                <div
                                    class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                    <label for="ip" class="text-end">Qty</label>
                                </div>
                                <div class="col-12 col-sm-7">
                                    <div class="input-group w-50">
                                        <input type="numeric" class="form-control" placeholder="QTY" id="qty"
                                            name="stok">
                                    </div>

                                </div>
                            </div>
                            <div class="form-group row pb-2">

                                <div
                                    class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                    <label for="ip" class="text-end">Harga</label>
                                </div>
                                <div class="col-12 col-sm-7">
                                    <div class="input-group w-50">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="harga" id="harga"
                                            name="harga">
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="card-footer">
                                    <input type="button" class="btn btn-secondary float-start" value="Cancel"
                                        onclick="window.history.back();">

                                    <input type="submit" class="btn btn-primary float-end" value="Tambah">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            {{-- @include('Masterdata.modal.modaladdbrand') --}}
    </div>
    {{-- @include('Masterdata.modal.modaladdtype') --}}

    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- /.content -->

@endsection
