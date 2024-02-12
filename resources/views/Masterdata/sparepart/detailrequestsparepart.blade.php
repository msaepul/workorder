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
                        <h1>Detail Permintaan Sparepart</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Detail Permintaan</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content center">
            <form action="{{ route('updaterequest_status', ['id' => $data->id]) }}" method="post">
                @csrf
                <div class="d-flex justify-content-center ">
                    <div class="card card-flat col-12 col-md-10" style="height: 60px; ">
                        <div class="card-body-a d-flex align-items-center">
                            <div class="left-links">
                                <div class="status-container">
                                    @if ($data->status == 1)
                                        @if (getDeptUser($data->user_id) == 'EDP' || getUserDept() != 'EDP')
                                            <input type="hidden" name="id_tx" value="{{ $data->id_tx }}">
                                            <button type="submit" name="status" value="2"
                                                class="btn btn-success mr-2"
                                                onclick="return confirm('Apakah anda ingin mengkonfirmasi Permintaan Sparepart?')">
                                                Confirm
                                            </button>

                                            <button type="submit" name="status" value="0" class="btn btn-secondary "
                                                onclick="return confirm('Apakah anda ingin membatalkan Permintaan Sparepart?')">
                                                Cancel
                                            </button>
                                        @endif
                                    @elseif ($data->status == 2)
                                        @if (getUserDept() == 'EDP')
                                            <input type="hidden" name="id_tx" value="{{ $data->id_tx }}">
                                            <button type="submit" name="status" value="3"
                                                class="btn btn-success mr-2"
                                                onclick="return confirm('Apakah anda ingin mengkonfirmasi Permintaan Sparepart?')">
                                                Keluarkan
                                            </button>
                                            <a href="{{ route('editrequest_sparepart', $data->id) }}"
                                                class="btn btn-secondary "> <i class="nav-icon fas fa-edit"></i>
                                                Edit</a> &nbsp;&nbsp;
                                            <button type="submit" name="status" value="0" class="btn btn-danger "
                                                onclick="return confirm('Apakah anda ingin membatalkan Permintaan Sparepart?')">
                                                Cancel
                                            </button>
                                        @else
                                            <span class="btn btn-secondary mr-2 disabled" data-toggle="modal"
                                                data-target="#confirmModal">Menunggu EDP Mengeluarkan Sparepart</span>
                                        @endif

                                    @endif

                                </div>
                            </div>
                            @if ($data->status != 0)
                                <div class="right-status">
                                    <div class="status-container">
                                        <div class="box{{ $data->status == 1 ? ' bg-primary' : '' }}">
                                            <span class="status">Draft</span>
                                        </div>
                                        <div class="arrow"></div>
                                    </div>
                                    <div class="status-container">
                                        <div class="box x{{ $data->status == 2 ? ' bg-primary' : '' }}">
                                            <span class="status">Confirm</span>
                                        </div>
                                        <div class="arrow"></div>
                                    </div>
                                    <div class="status-container">
                                        <div class="box x{{ $data->status == 3 ? ' bg-primary' : '' }}">
                                            <span class="status">Done</span>
                                        </div>
                                    </div>

                                </div>
                            @else
                                <div class="right-status">
                                    <div class="status-container">
                                        <div class="box{{ $data->status == 1 ? ' bg-primary' : '' }}">
                                            <span class="status">Cancel</span>
                                        </div>
                                    </div>

                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
            <form method="POST" action="{{ route('sparepartout_proses') }}">
                @csrf
                <div class="d-flex justify-content-center">
                    <div class="card card-success card-outline col-12 col-md-10">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-edit"></i>
                                Transaksi Permintaan Sparepart {{ $data->id_tx }}
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
                                    <span class="form-control form-control-border disabled-input" name="no_wo">
                                        {{ $data->tgl_permintaan }}</span>
                                </div>
                            </div>

                            <hr>
                            <div class="bg-success rounded d-flex align-items-center justify-content-center">
                                <span class="text-white fw-bold fs-10">Rincian Permintaan Barang</span>
                            </div>



                            <input type="hidden" class="form-control w-50" id="id_cabang" name="id_cabang"
                                value="{{ $cabang }}">
                            <table class="table table-bordered text-center pb-2" id="items_table">
                                <tr>
                                    <th>Nama Sparepart</th>
                                    {{-- <th>
                                        <bold>Stok</bold>
                                    </th> --}}
                                    <th>
                                        <bold>qty</bold>
                                    </th>
                                    <th>
                                        <bold>Keterangan</bold>
                                    </th>
                                </tr>

                                @foreach ($groupedHistory as $id_tx => $group)
                                    @php
                                        $groupSize = count($group);
                                    @endphp
                                    @foreach ($group as $key => $item)
                                        <tr>
                                            <td>
                                                {{ getNameSparepart($item['id_spr']) }}</td>

                                            <td>{{ $item['qty'] }}</td>
                                            @if ($key === 0)
                                                <td class="align-middle text-center" rowspan="{{ $groupSize }}">
                                                    {{ $item->keterangan }}
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endforeach


                            </table>
                            Dibuat oleh {{ getFullName($data->user_id) }}
                            <br>

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

    </div>
    {{-- @include('Masterdata.modal.modaladdtype') --}}

    </section>

    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


@endsection
