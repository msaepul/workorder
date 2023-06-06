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
                        <h1>Contact us</h1>
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
                <div class="card card-primary card-outline col-8">
                    <div class="card-body row">

                        <div class="form-group row pb-2">
                            <div class="col-3 d-flex align-items-center justify-content-end">
                                <label for="inputName">Nama Perangkat</label>
                            </div>
                            <div class="col-7">
                                <input type="text" id="inputName" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row pb-2 ">
                            <div class="col-3 d-flex align-items-center justify-content-end">
                                <label for="inputName">Jenis Perangkat</label>
                            </div>
                            <div class="col-7">
                                <input type="text" id="inputName" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row pb-2 ">
                            <div class="col-3 d-flex align-items-center justify-content-end">
                                <label for="inputName">Type</label>
                            </div>
                            <div class="col-7">
                                <input type="text" id="inputName" class="form-control" />
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-primary">New</button>
                            </div>
                        </div>
                        <div class="form-group row pb-2 ">
                            <div class="col-3 d-flex align-items-center justify-content-end">
                                <label for="inputName">Spesifikasi</label>
                            </div>
                            <div class="col-7">
                                <input type="text" id="inputName" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row pb-2 ">
                            <div class="col-3 d-flex align-items-center justify-content-end">
                                <label for="inputName">Departemen/lokasi</label>
                            </div>
                            <div class="col-7">
                                <input type="text" id="inputName" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row pb-2 ">
                            <div class="col-3 d-flex align-items-center justify-content-end">
                                <label for="inputName">Pengguna</label>
                            </div>
                            <div class="col-7">
                                <input type="text" id="inputName" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row pb-2 ">
                            <div class="col-3 d-flex align-items-center justify-content-end">
                                <label for="inputName">ID Teamviewer</label>
                            </div>
                            <div class="col-7">
                                <input type="text" id="inputName" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row pb-2 ">
                            <div class="col-3 d-flex align-items-center justify-content-end">
                                <label for="inputName">ID Anydesk</label>
                            </div>
                            <div class="col-7">
                                <input type="text" id="inputName" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row pb-2 ">
                            <div class="col-3 d-flex align-items-center justify-content-end">
                                <label for="inputName">IP</label>
                            </div>
                            <div class="col-7">
                                <input type="text" id="inputName" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Send message">
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
