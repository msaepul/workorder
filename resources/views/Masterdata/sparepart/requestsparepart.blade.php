@extends('layouts.mainlayout')

@section('title', 'Sparepart Request')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Request Sparepart </h1>
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
            <form method="POST" action="{{ route('sparepartout_proses') }}">
                @csrf
                <div class="d-flex justify-content-center">
                    <div class="card card-success card-outline col-12 col-md-10">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-edit"></i>
                                Tx sparepart Keluar
                            </h3>
                        </div>
                        <div class="card-body pad table-responsive">
                            @if (session('success'))
                                <div id="success-alert" class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div id="myAlert" class="alert alert-success alert-dismissible fade show" role="alert">
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
                                    <label for="tgl_permintaan">Tanggal Permintaan</label>
                                    <input type="date" class="form-control" name="tgl_permintaan"
                                        value="{{ old('tgl_permintaan') }}" required min="{{ date('Y-m-d') }}">

                                </div>
                                <div class="col-md-3">

                                </div>
                                <div class="col-md-5">
                                    <label for="harga_terbaru">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" required>{{ old('keterangan') }}</textarea>
                                </div>


                            </div>

                            <hr>
                            <div class="bg-success rounded d-flex align-items-center justify-content-center">
                                <span class="text-white fw-bold fs-10">Rincian Barang</span>
                            </div>



                            <input type="hidden" class="form-control w-50" id="id_cabang" name="id_cabang"
                                value="{{ $cabang }}">
                            <input type="hidden" class="form-control w-50" id="status" name="status" value="1">
                            <input type="hidden" class="form-control w-50" id="user_id" name="user_id"
                                value="{{ getUserID() }}">
                            <table class="table table-bordered text-center pb-2" id="items_table">
                                <tr>
                                    <th>Nama Sparepart</th>
                                    <th>
                                        <bold>Stok</bold>
                                    </th>
                                    <th>
                                        <bold>qty</bold>
                                    </th>
                                    <th>
                                        <bold>+/-</bold>
                                    </th>
                                </tr>
                                <tr>

                                    <td>
                                        <select class="form-control select2" name="sparepart[]" style="width: 100%;"
                                            required onchange="showStok(this)">
                                            <option value="">Pilih Sparepart</option>
                                            @foreach ($sparepart as $part)
                                                <option value="{{ $part->id }}" data-stok="{{ $part->stok }}"
                                                    style="text-align: left;">
                                                    {{ $part->nama_sparepart }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </td>
                                    <td style="width: 200px;">
                                        <input type="text" class="form-control" name="stok[]" value="" disabled>
                                    </td>

                                    <td style="width: 200px;">
                                        <input type="text" class="form-control" name="qty[]"
                                            value="{{ old('qty') }}" onkeyup="calculateTotal(this)" required>
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
                                <div class="card-footer text-center">
                                    <input type="button" class="btn btn-secondary float-start" value="Cancel"
                                        onclick="window.history.back();">

                                    <input type="submit" class="btn btn-success float-end" value="Minta Sparepart">
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

            // Mengatur HTML untuk elemen input baru
            cell1.innerHTML =
                '<select class="form-control item-select" name="sparepart[]"style="width: 100%;" onchange="showStok(this)" ><option value="">Pilih Sparepart</option>@foreach ($sparepart as $part)<option value="{{ $part->id }}" data-stok="{{ $part->stok }}">{{ $part->nama_sparepart }}</option>@endforeach</select>';
            cell3.innerHTML = ' <input type="text" class="form-control" name="qty[]" onkeyup="calculateTotal(this)">';
            cell2.innerHTML =
                ' <input type="text" class="form-control" name="stok[]" value="" disabled>';
            cell4.innerHTML =
                ' <button type="button" class="btn btn-transparent" onclick="deleteRow(this)"><i class="fas fa-trash text-success"></i></button>';

            // Menginisialisasi Select2 pada elemen select yang baru dibuat
            $('.item-select').select2();
        }

        function deleteRow(row) {
            var i = row.parentNode.parentNode.rowIndex;
            document.getElementById("items_table").deleteRow(i);
        }
    </script>
    <script>
        function showStok(selectElement) {
            var selectedIndex = selectElement.selectedIndex;
            var stok = selectElement.options[selectedIndex].getAttribute('data-stok');
            var row = selectElement.parentNode.parentNode;
            var stokInput = row.querySelector('input[name="stok[]"]');
            stokInput.value = stok;
        }
    </script>

    <script>
        var inputDate = document.getElementById('tgl_permintaan');
        inputDate.addEventListener('change', function() {
            var selectedDate = new Date(this.value);
            var currentDate = new Date();

            if (selectedDate < currentDate) {
                alert('Tanggal tidak boleh kurang dari tanggal sekarang');
                this.value = ''; // Menghapus nilai jika tidak valid
            }
        });
    </script>

    </div>
    {{-- @include('Masterdata.modal.modaladdtype') --}}

    </section>

    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


@endsection
