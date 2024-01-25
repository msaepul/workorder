@extends('layouts.mainlayout')

@section('title', 'Edit Perangkat')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Perangkat</h1>
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
            <form action="{{ route('update_perangkat', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">

                    <!-- Default box -->
                    <div class="card card-primary card-outline col-12 col-md-8">
                        <ul class="nav nav-tabs" id="myTabs">
                            <li class="nav-item">
                                <a class="nav-link active text-dark font-weight-bold" id="tab1" data-toggle="tab"
                                    href="#contentTab1">Informasi Perangkat</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark font-weight-bold" id="tab2" data-toggle="tab"
                                    href="#contentTab2">Pembelian</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark font-weight-bold" id="tab3" data-toggle="tab"
                                    href="#contentTab3">Informasi Lainnya</a>
                            </li>
                            <!-- Add more tabs as needed -->
                        </ul>

                        <div class="tab-content mt-2">
                            <div class="tab-pane fade show active" id="contentTab1">
                                <div class="form-group row pb-2">
                                    <div
                                        class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                        <label for="nama_perangkat" class="text-end">Nama Perangkat</label>
                                    </div>
                                    <div class="col-12 col-md-7 col-sm-7">
                                        <input type="text" id="nama_perangkat" class="form-control" name="nama_perangkat"
                                            placeholder="Masukkan No Inventaris" value="{{ $data->nama_perangkat }}" />
                                    </div>
                                </div>
                                <div class="form-group row pb-2 ">
                                    <div
                                        class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end ">
                                        <label for="jenis_perangkat" class="text-end">Jenis Perangkat</label>
                                    </div>
                                    <div class="col-12 col-sm-7">
                                        <select class="form-control select2bs4" id="id_jenis" name="id_jenis"
                                            style="width: 100%;">
                                            <option value="">Pilih Jenis</option>
                                            @foreach ($jeniss as $jenis)
                                                <option value="{{ $jenis->id }}"
                                                    {{ $data->id_jenis == $jenis->id ? 'selected' : '' }}>
                                                    {{ $jenis->jenis_perangkat }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                                <div class="form-group row pb-2 ">
                                    <div
                                        class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                        <label for="nama_type" class="text-end">Type</label>
                                    </div>
                                    <div class="col-12 col-sm-7">

                                        <select class="form-control select2bs4" id="nama_type" name="nama_type"
                                            style="width: 100%;">
                                            <option value="">Pilih Jenis</option>
                                            @foreach ($types as $type)
                                                <option value="{{ $type->id }}"
                                                    {{ $data->id_type == $type->id ? 'selected' : '' }}>
                                                    {{ $type->name_type }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div
                                        class="col-12 col-md-2 col-sm-2 d-flex align-items-center justify-content-sm-start justify-content-lg-start">
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#myModaltype" class="btn btn-primary">New</button>
                                    </div>
                                </div>
                                <div class="form-group row pb-2 ">
                                    <div
                                        class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                        <label for="nama_brand" class="text-end">Brand/merk</label>
                                    </div>
                                    <div class="col-12 col-sm-7">
                                        <select class="form-control select2bs4" id="nama_brand" name="nama_brand"
                                            style="width: 100%;">
                                            <option value="">Pilih Jenis</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}"
                                                    {{ $data->id_brand == $brand->id ? 'selected' : '' }}>
                                                    {{ $brand->name_brand }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div
                                        class="col-12 col-md-2 col-sm-2 d-flex align-items-center justify-content-sm-start justify-content-lg-start">
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#myModalbrand" class="btn btn-primary">New</button>
                                    </div>
                                </div>
                                <div class="form-group row pb-2 ">
                                    <div
                                        class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                        <label for="spesifikasi" class="text-end">Spesifikasi</label>
                                    </div>
                                    <div class="col-12 col-sm-7">
                                        <textarea class="form-control" id="spesifikasi" name="spesifikasi" placeholder="Spesifikasi perangkat" rows="4"
                                            cols="50">{{ old('spesifikasi', $data->spesifikasi) }}</textarea>

                                    </div>
                                </div>


                                <div class="form-group row pb-2 ">
                                    <div
                                        class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                        <label for="user_id" class="text-end">User / Dept</label>
                                    </div>
                                    <div class="col-12 col-sm-7">
                                        {{-- <select class="form-control select2 " id="user_id" name="user_id"
                                            style="width: 100%;" value="{{ old('user_id') }}">
                                            <option value="">Pilih User</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ $data->user_id == $user->id ? 'selected' : '' }}>
                                                    {{ $user->nama_lengkap }}
                                                </option>
                                            @endforeach
                                        </select> --}}
                                    </div>
                                </div>
                                <div class="form-group row pb-2 ">
                                    <div
                                        class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                        <label for="nama_status" class="text-end">Status</label>
                                    </div>
                                    <div class="col-12 col-sm-7 ">
                                        <select class="form-control" id="status" name="status" style="width: 100%;">
                                            <option value="">Pilih Status</option>
                                            <option value="USED" {{ $data->status == 'USED' ? 'selected' : '' }}>
                                                Digunakan
                                            </option>
                                            <option value="BROKEN" {{ $data->status == 'BROKEN' ? 'selected' : '' }}>Rusak
                                            </option>
                                            <option value="IN STOCK" {{ $data->status == 'IN STOCK' ? 'selected' : '' }}>
                                                Stok
                                            </option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contentTab2">
                                <div class="form-group row pb-2">
                                    <div
                                        class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                        <label for="nopo" class="text-end">No PO</label>
                                    </div>
                                    <div class="col-12 col-sm-7">
                                        <input type="text" id="nopo" class="form-control" name="nopo"
                                            placeholder="Nomor PO" value="{{ $data->nopo }}" />
                                    </div>
                                </div>
                                <div class="form-group row pb-2 ">
                                    <div
                                        class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                        <label for="supplier" class="text-end">Supplier</label>
                                    </div>
                                    <div class="col-12 col-sm-7">
                                        <input type="text" id="supplier" class="form-control" name="supplier"
                                            placeholder="Supplier" value="{{ $data->supplier }}" />
                                    </div>
                                </div>
                                <div class="form-group row pb-2 ">
                                    <div
                                        class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                        <label for="tgl_pbl" class="text-end">Tanggal Pembelian
                                        </label>
                                    </div>
                                    <div class="col-12 col-sm-7">
                                        <input type="date" class="form-control w-50" id="tgl_pbl" name="tgl_pbl"
                                            value="{{ $data->date_purchase }}">

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
                                            <input type="text" class="form-control" placeholder="harga"
                                                id="harga" name="harga" value="{{ $data->harga }}">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contentTab3">
                                <div class="form-group row pb-2">
                                    <div
                                        class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                        <label for="ip" class="text-end">IP</label>
                                    </div>
                                    <div class="col-12 col-sm-7">
                                        <input type="text" id="ip" class="form-control" name="ip"
                                            placeholder="IP Address" value="{{ $data->ip }}" />
                                    </div>
                                </div>
                                <div class="form-group row pb-2">
                                    <div
                                        class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                        <label for="macaddress" class="text-end">Mac address</label>
                                    </div>
                                    <div class="col-12 col-sm-7">
                                        <input type="text" id="macaddress" class="form-control" name="macaddress"
                                            placeholder="Mac address" value="{{ $data->mac_address }}" />
                                    </div>
                                </div>
                                <div class="form-group row pb-2 ">
                                    <div
                                        class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                        <label for="id_teamviewer" class="text-end">ID Teamviewer</label>
                                    </div>
                                    <div class="col-12 col-sm-7">
                                        <input type="text" id="id_teamviewer" class="form-control"
                                            name="id_teamviewer" placeholder="ID teamviewer"
                                            value="{{ $data->id_teamviewer }}" />
                                    </div>
                                </div>
                                <div class="form-group row pb-2 ">
                                    <div
                                        class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                        <label for="id_anydesk" class="text-end">ID Anydesk</label>
                                    </div>
                                    <div class="col-12 col-sm-7">
                                        <input type="text" id="id_anydesk" class="form-control" name="id_anydesk"
                                            placeholder="ID Anydesk" value="{{ $data->id_anydesk }}" />
                                    </div>
                                </div>
                            </div>
                            <!-- Add more tab content as needed -->
                        </div>
                    </div>
                    <div class="col-md-4 col-4">
                        <div class="card">
                            <div class="card-header ">
                                <center>
                                    <h5>History Perbaikan</h5>
                                </center>
                            </div>
                            <div class="card-body">
                                @if (session('success'))
                                    <div id="success-alert" class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <table id="example" class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No WO</th>

                                            <th>Status</th>
                                            <th>Dibuat oleh</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($workorders as $wo)
                                            <tr>
                                                <td class="text-center">{{ $wo->no_wo }}</td>
                                                <td class="text-center">{{ $wo->wo_create }}</td>
                                                <td class="text-center">{{ getFullName($wo->user_id) }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                </div>


            </form>
            @include('Masterdata.modal.modaladdbrand')
    </div>
    @include('Masterdata.modal.modaladdtype')

    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- /.content -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                // 'ajax': 'https://gyrocode.github.io/files/jquery-datatables/arrays.json',
                'rowsGroup': [2]
            });
        });
    </script>
@endsection
