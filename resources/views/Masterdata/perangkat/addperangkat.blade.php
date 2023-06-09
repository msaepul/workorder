@extends('layouts.mainlayout')

@section('title', 'Work Order')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah Perangkat</h1>
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
            <form action="{{ route('perangkat_proses') }}" method="POST">
                @csrf
                <div class="d-flex justify-content-center">
                    <!-- Default box -->
                    <div class="card card-primary card-outline col-12 col-md-8">
                        <div class="card-body">

                            <div class="form-group row pb-2">
                                <div
                                    class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                    <label for="nama_perangkat" class="text-end">Nama Perangkat</label>
                                </div>
                                <div class="col-12 col-md-7 col-sm-7">
                                    <input type="text" id="nama_perangkat" class="form-control" name="nama_perangkat" />
                                </div>
                            </div>
                            <div class="form-group row pb-2 ">
                                <div class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-lg-end ">
                                    <label for="jenis_perangkat" class="text-end">Jenis Perangkat</label>
                                </div>
                                <div class="col-12 col-sm-7">
                                    <input type="text" id="jenis_perangkat" class="form-control"
                                        name="jenis_perangkat" />
                                </div>
                            </div>
                            <div class="form-group row pb-2 ">
                                <div
                                    class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                    <label for="nama_brand" class="text-end">Brand/merk</label>
                                </div>
                                <div class="col-12 col-sm-7">
                                    <input type="text" id="nama_brand" class="form-control" />
                                </div>
                                <div
                                    class="col-12 col-md-2 col-sm-2 d-flex align-items-center justify-content-sm-start justify-content-lg-start">
                                    <button type="button" class="btn btn-primary">New</button>
                                </div>
                            </div>
                            <div class="form-group row pb-2 ">
                                <div
                                    class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                    <label for="nama_type" class="text-end">Type</label>
                                </div>
                                <div class="col-12 col-sm-7">
                                    <input type="text" id="nama_type" class="form-control" />
                                </div>
                                <div
                                    class="col-12 col-md-2 col-sm-2 d-flex align-items-center justify-content-sm-start justify-content-lg-start">
                                    <button type="button" class="btn btn-primary">New</button>
                                </div>
                            </div>
                            <div class="form-group row pb-2 ">
                                <div
                                    class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                    <label for="spesifikasi" class="text-end">Spesifikasi</label>
                                </div>
                                <div class="col-12 col-sm-7">
                                    <textarea class="form-control" id="spesifikasi" name="message" rows="4" cols="50" required></textarea>
                                </div>
                            </div>
                            <div class="form-group row pb-2 ">
                                <div
                                    class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                    <label for="tgl_pbl" class="text-end">Tanggal Pembelian</label>
                                </div>
                                <div class="col-12 col-sm-7">
                                    <input type="date" class="form-control w-50" id="tgl_pbl">
                                </div>
                            </div>
                            <div class="form-group row pb-2 ">
                                <div
                                    class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                    <label for="dept" class="text-end">Departemen / lokasi</label>
                                </div>
                                <div class="col-12 col-sm-7">
                                    <input type="text" id="dept" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group row pb-2 ">
                                <div
                                    class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                    <label for="user_id" class="text-end">Pengguna</label>
                                </div>
                                <div class="col-12 col-sm-7">
                                    <input type="text" id="user_id" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group row pb-2 ">
                                <div
                                    class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                    <label for="id_teamviewer" class="text-end">ID Teamviewer</label>
                                </div>
                                <div class="col-12 col-sm-7">
                                    <input type="text" id="id_teamviewer" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group row pb-2 ">
                                <div
                                    class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                    <label for="id_anydesk" class="text-end">ID Anydesk</label>
                                </div>
                                <div class="col-12 col-sm-7">
                                    <input type="text" id="id_anydesk" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group row pb-2 ">
                                <div
                                    class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                    <label for="ip" class="text-end">IP</label>
                                </div>
                                <div class="col-12 col-sm-7">
                                    <input type="text" id="ip" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group row pb-2 ">
                                <div
                                    class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                    <label for="macaddress" class="text-end">Mac address</label>
                                </div>
                                <div class="col-12 col-sm-7">
                                    <input type="text" id="macaddress" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="card-footer">
                                    <input type="cancel" class="btn btn-secondary float-start" value="Cancel">
                                    <input type="submit" class="btn btn-primary float-end" value="Tambah">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- /.content -->
@endsection
