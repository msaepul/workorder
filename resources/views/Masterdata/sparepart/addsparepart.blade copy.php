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
                                <label for="tgl_pbl">Tgl PO</label>
                                <input type="date" class="form-control" name="tgl_pbl" value="{{ old('tgl_pbl') }}">
                            </div>
                            <div class="col-md-3">
                                <label for="nopo">No PO</label>
                                <input type="text" class="form-control" name="nopo" value="{{ old('nopo') }}">
                            </div>
                            <div class="col-md-3">
                                <label for="harga_terbaru">Supplier</label>
                                <select class="form-control select2" id="supplier" name="supplier" style="width: 100%;">
                                    <option value="">Pilih Supplier</option>
                                    @foreach ($suppliers as $supp)
                                    <option value="{{ $supp->id }}" @if (old('supp_id')==$supp->id) selected @endif>
                                        {{ $supp->nama_supplier }}
                                        @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 d-flex flex-column">
                                <div class="mt-auto">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" class="btn btn-primary">Tambah Supplier</button>
                                </div>
                            </div>
                        </div>

                        <hr>
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center">
                                <span class="text-white fw-bold fs-10">Rincian Barang</span>
                            </div>



                        <input type="hidden" class="form-control w-50" id="id_cabang" name="id_cabang" value="{{ $cabang }}">
                        <table class="table table-bordered text-center pb-2">
                            <tr>

                                <th>Nama Barang
                                    <a href="#myModalsparepart" data-toggle="modal" data-toggle="tooltip" title="Tambah sparepart" class="circle float-right">+</a>

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
                                    <select class="form-control select2" id="sparepart" name="sparepart" style="width: 100%;">
                                        <option value="">Pilih Sparepart</option>
                                        @foreach ($sparepart as $part)
                                        <option value="{{ $part->id }}">
                                            {{ $part->nama_sparepart }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td style="width: 100px;">
                                    <input type="text" class="form-control" name="qty" value="{{ old('qty') }}" onchange="calculateTotal()">
                                </td>
                                <td>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="harga" id="harga" name="harga" onchange="calculateTotal()">
                                    </div>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="harga_total" id="harga_total" value="" disabled>
                                </td>
                                <td>
                                    <button class="btn btn-transparent"><i class="fas fa-plus text-primary"></i></button>
                                </td>
                            </tr>

                        </table>
                    </div>
                    <!-- /.card -->
                    <div class="form-group">
                        <div class="card-footer">
                            <input type="button" class="btn btn-secondary float-start" value="Cancel" onclick="window.history.back();">

                            <input type="submit" class="btn btn-primary float-end" value="Tambah">
                        </div>
        </form>

</div>
</div>

</div>
<!-- /.col -->
@include('Masterdata.modal.modaladdsupplier')
@include('Masterdata.modal.modaladdsparepart')
</div>
{{-- @include('Masterdata.modal.modaladdtype') --}}
<div class="card">
    <div class="card-body">

        <table id="items_table">
            <tr>
                <th>Nama Barang</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
            <tr>
                <td>
                    <select class="item-select" name="item[]">
                        <option value="Barang 1">Barang 1</option>
                        <option value="Barang 2">Barang 2</option>
                        <option value="Barang 3">Barang 3</option>
                    </select>
                </td>
                <td><input type="number" name="qty[]" min="1"></td>
                <td><input type="number" name="harga[]" min="0"></td>
                <td><button onclick="deleteRow(this)">Hapus</button></td>
            </tr>
        </table>

        <button onclick="addRow()">Tambah Baris</button>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                // Inisialisasi Select2 pada elemen dengan class "item-select"
                $('.item-select').select2();
            });

            function addRow() {
                // Mendapatkan jumlah baris saat ini di tabel
                var rowCount = document.getElementById("items_table").rows.length;

                // Membuat elemen-elemen input baru
                var newRow = document.getElementById("items_table").insertRow(rowCount);
                var cell1 = newRow.insertCell(0);
                var cell2 = newRow.insertCell(1);
                var cell3 = newRow.insertCell(2);
                var cell4 = newRow.insertCell(3);

                // Mengatur HTML untuk elemen input baru
                cell1.innerHTML =
                    '<select class="item-select" name="item[]"><option value="Barang 1">Barang 1</option><option value="Barang 2">Barang 2</option><option value="Barang 3">Barang 3</option></select>';
                cell2.innerHTML = '<input type="number" name="qty[]" min="1">';
                cell3.innerHTML = '<input type="number" name="harga[]" min="0">';
                cell4.innerHTML = '<button onclick="deleteRow(this)">Hapus</button>';

                // Menginisialisasi Select2 pada elemen select yang baru dibuat
                $('.item-select').select2();
            }

            function deleteRow(row) {
                var i = row.parentNode.parentNode.rowIndex;
                document.getElementById("items_table").deleteRow(i);
            }
        </script>

        <script>
            function calculateTotal() {
                var qty = parseFloat(document.getElementsByName("qty")[0].value);
                var harga = parseFloat(document.getElementsByName("harga")[0].value);
                var hargaTotal = qty * harga;

                // Jika hargaTotal adalah NaN (Not a Number), maka atur nilai menjadi 0
                if (isNaN(hargaTotal)) {
                    hargaTotal = 0;
                }

                document.getElementById("harga_total").value = hargaTotal;
            }
        </script>
    </div>
</div>
</section>

<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- /.content -->

@endsection