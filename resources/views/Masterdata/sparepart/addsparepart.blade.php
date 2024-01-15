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
            <form method="POST" action="{{ route('sparepart_proses') }}">
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
                                    <input type="date" class="form-control" name="tgl_pbl" value="{{ old('tgl_pbl') }} "
                                        required>
                                </div>
                                <div class="col-md-3">
                                    <label for="nopo">No PO</label>
                                    <input type="text" class="form-control" name="nopo" value="{{ old('nopo') }} "
                                        required>
                                </div>
                                <div class="col-md-3">
                                    <label for="harga_terbaru">Supplier</label>
                                    <select class="form-control select2" id="supplier" name="supplier" style="width: 100%;"
                                        required>
                                        <option value="">Pilih Supplier</option>
                                        @foreach ($suppliers as $supp)
                                            <option value="{{ $supp->id }}"
                                                @if (old('supp_id') == $supp->id) selected @endif>
                                                {{ $supp->nama_supplier }}
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 d-flex flex-column">
                                    <div class="mt-auto">
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#myModal" class="btn btn-primary">Tambah Supplier</button>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center">
                                <span class="text-white fw-bold fs-10">Rincian Barang</span>
                            </div>



                            <input type="hidden" class="form-control w-50" id="id_cabang" name="id_cabang"
                                value="{{ $cabang }}">
                            <table class="table table-bordered text-center pb-2" id="items_table">
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
                                        <select class="form-control select2" name="sparepart[]" style="width: 100%;"
                                            required>
                                            <option value="">Pilih Sparepart</option>
                                            @foreach ($sparepart as $part)
                                                <option value="{{ $part->id }}" style="text-align: left;">
                                                    {{ $part->nama_sparepart }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td style="width: 100px;">
                                        <input type="text" class="form-control" name="qty[]"
                                            value="{{ old('qty') }}" onkeyup="calculateTotal(this)" required>
                                    </td>

                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="harga" id="harga"
                                                name="harga[]" onkeyup="calculateTotal(this)" required>
                                        </div>

                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="text" class="form-control" name="harga_total"
                                                value="{{ old('harga_total') }}" disabled>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-transparent" onclick="addRow()"><i
                                                class="fas fa-plus text-primary"></i>
                                        </button>


                                    </td>
                                </tr>

                            </table>

                            <br>

                            <div class="form-group">
                                <div class="card-footer">
                                    <input type="button" class="btn btn-secondary float-start" value="Cancel"
                                        onclick="window.history.back();">

                                    <input type="submit" class="btn btn-primary float-end" value="Tambah">
                                </div>
                            </div>
            </form>
    </div>

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
            var cell5 = newRow.insertCell(4);

            // Mengatur HTML untuk elemen input baru
            cell1.innerHTML =
                '<select class="form-control item-select" name="sparepart[]"style="width: 100%;"><option value="">Pilih Sparepart</option>@foreach ($sparepart as $part)<option value="{{ $part->id }}">{{ $part->nama_sparepart }}</option>@endforeach</select>';
            cell2.innerHTML = ' <input type="text" class="form-control" name="qty[]" onkeyup="calculateTotal(this)">';
            cell3.innerHTML =
                '  <div class="input-group"><div class="input-group-prepend"><span class="input-group-text">Rp</span></div><input type="text" class="form-control" placeholder="harga" id="harga"name="harga[]" onkeyup="calculateTotal(this)"></div>';
            cell4.innerHTML =
                '    <div class="input-group"> <div class="input-group-prepend"><span class="input-group-text">Rp</span></div><input type="text" class="form-control" name="harga_total"value="" disabled>';
            cell5.innerHTML =
                ' <button type="button" class="btn btn-transparent" onclick="deleteRow(this)"><i class="fas fa-trash text-danger"></i></button>';

            // Menginisialisasi Select2 pada elemen select yang baru dibuat
            $('.item-select').select2();
        }

        function deleteRow(row) {
            var i = row.parentNode.parentNode.rowIndex;
            document.getElementById("items_table").deleteRow(i);
        }

        function calculateTotal(element) {
            var row = $(element).closest('tr');
            var qty = parseFloat(row.find('input[name="qty[]"]').val());
            var harga = parseFloat(row.find('input[name="harga[]"]').val());

            if (!isNaN(qty) && !isNaN(harga)) {
                var total = qty * harga;
                var formattedTotal = formatNumber(total);
                row.find('input[name="harga_total"]').val(formattedTotal);
            } else {
                row.find('input[name="harga_total"]').val('');
            }
        }

        function formatNumber(number) {
            return number.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    </script>
    <!-- /.col -->
    @include('Masterdata.modal.modaladdsupplier')
    @include('Masterdata.modal.modaladdsparepart')
    </div>
    {{-- @include('Masterdata.modal.modaladdtype') --}}

    </section>

    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


@endsection
