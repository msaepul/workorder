@extends('layouts.mainlayout')

@section('title', 'Tambah Sparepart')


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
            <div class="d-flex justify-content-center">
                <!-- Default box -->
                <div class="card card-primary card-outline col-12 col-md-8">
                    <div class="card-body">

                        <div class="form-group row pb-2">
                            <div
                                class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                <label for="inputName" class="text-end">Nama Sparepart</label>
                            </div>
                            <div class="col-12 col-md-7 col-sm-7">
                                <input type="text" id="inputName" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row pb-2 ">
                            <div
                                class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                <label for="inputName" class="text-end">Jenis Sparepart</label>
                            </div>
                            <div class="col-12 col-md-7 col-sm-7">
                                <input type="text" id="inputName" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row pb-2 ">
                            <div
                                class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                <label for="inputName" class="text-end">Brand/merk</label>
                            </div>
                            <div class="col-12 col-md-7 col-sm-7">
                                <input type="text" id="inputName" class="form-control" />
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-primary">New</button>
                            </div>
                        </div>
                        <div class="form-group row pb-2 ">
                            <div
                                class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                <label for="inputName" class="text-end">Spesifikasi</label>
                            </div>
                            <div class="col-12 col-md-7 col-sm-7">
                                <textarea class="form-control" name="message" rows="4" cols="50" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row pb-2 ">
                            <div
                                class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                <label for="inputName" class="text-end">Tanggal Pembelian</label>
                            </div>
                            <div class="col-12 col-md-7 col-sm-7">
                                <input type="date" class="form-control w-50">
                            </div>
                        </div>
                        <div class="form-group row pb-2 ">
                            <div
                                class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                <label for="inputName" class="text-end">Stok Awal</label>
                            </div>
                            <div class="col-12 col-md-7 col-sm-7">
                                <input type="number" id="inputName" class="form-control w-50" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="card-footer">
                                <input type="submit" class="btn btn-secondary float-start" value="Cancel">
                                <input type="submit" class="btn btn-primary float-end" value="Tambah">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- /.content -->
@endsection
