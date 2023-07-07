@extends('layouts.mainlayout')

@section('title', 'Data Order')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Detail WO {{ $workorders->no_wo }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Project Edit</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-12">
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
                    @if (session('errorMessage'))
                        <div class="alert alert-danger">
                            {{ session('errorMessage') }}
                        </div>
                    @endif
                    <form action="{{ route('woupdate_status', ['id' => $workorders->id]) }}" method="POST">
                        @csrf
                        <div class="d-flex justify-content-center ">
                            <div class="card card-flat col-12 col-md-10" style="height: 60px; ">
                                <div class="card-body-a d-flex align-items-center">

                                    <div class="left-links">
                                        <form action="{{ route('woupdate_status2', ['id' => $workorders->id]) }}"
                                            method="POST">
                                            @csrf
                                            @if ($workorders->status == 0)
                                                <div class="status-container">
                                                    <div class="box bg-secondary disabled-input">
                                                        <span class="status">Cancel</span>
                                                    </div>
                                                </div>
                                            @elseif ($workorders->status == 1)
                                                @if (getUserDept() == 'EDP')
                                                    <button type="submit" name="status" value="0"
                                                        class="btn btn-danger mr-2"
                                                        onclick="return confirm('Apakah anda ingin membatalkan WO nya?')">Cancel</button>
                                                @else
                                                    <button type="submit" name="status" value="2"
                                                        class="btn btn-danger mr-2"
                                                        onclick="return confirm('Apakah anda ingin mengkonfirmasi WO nya?')">Confirm</button>
                                                    <a href="{{ route('Workorder_edit', ['id' => $workorders->id]) }}"
                                                        class="btn btn-warning">Edit</a>
                                                @endif
                                            @elseif ($workorders->status == 2)
                                                @if (getUserDept() == 'EDP')
                                                    <button type="submit" name="status" value="3"
                                                        class="btn btn-success mr-2"
                                                        onclick="return confirm('Apakah anda ingin membatalkan WO nya?')">Confirm
                                                        EDP</button>
                                                @endif
                                            @elseif ($workorders->status == 3)
                                                @if (getUserDept() == 'EDP')
                                                    <button type="submit" name="status" value="4"
                                                        class="btn btn-success mr-2"
                                                        onclick="return confirm('Apakah anda ingin menyelesaikan WO?')">Wo
                                                        Selesai</button>
                                                    <input type="hidden" name="date_actual" value="{{ now() }}">
                                                @else
                                                    <span class="btn btn-secondary mr-2 disabled" data-toggle="modal"
                                                        data-target="#confirmModal"> EDP Sedang Mengerjakan WO</span>
                                                @endif

                                            @endif


                                    </div>
                                    @if ($workorders->status != 0)
                                        <div class="right-status">
                                            <div class="status-container">
                                                <div class="box {{ $workorders->status == 1 ? 'bg-primary' : '' }}">
                                                    <span class="status">Draft</span>
                                                </div>
                                                <div class="arrow"></div>
                                            </div>
                                            <div class="status-container">
                                                <div class="box {{ $workorders->status == 2 ? 'bg-primary' : '' }}">
                                                    <span class="status">Confirm</span>
                                                </div>
                                                <div class="arrow"></div>
                                            </div>
                                            <div class="status-container">
                                                <div class="box {{ $workorders->status == 3 ? 'bg-primary' : '' }}">
                                                    <span class="status">On Progress</span>
                                                </div>
                                                <div class="arrow"></div>
                                            </div>
                                            <div class="status-container">
                                                <div class="box {{ $workorders->status == 4 ? 'bg-primary' : '' }}">
                                                    <span class="status">Done</span>
                                                </div>
                                            </div>

                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>

                        <!-- /.card -->
                        <div class="d-flex justify-content-center">
                            <div class="card card-secondary card-outline col-12 col-md-10">
                                <div class="card-header">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h3 class="card-title font-weight-bold">Form Work Order</h3>
                                        <div class="ml-auto">
                                            <button class="btn btn-link btn-toggle-collapse" type="button"
                                                data-toggle="collapse" data-target="#collapseCard" aria-expanded="false"
                                                aria-controls="collapseCard">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="collapse" id="collapseCard">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="nomor" class="col-sm-2 col-form-label">Nomor WO</label>
                                            <div class="col-sm-3">
                                                <span class="form-control form-control-border disabled-input"
                                                    name="no_wo"> {{ $workorders->no_wo }}</span>
                                            </div>
                                            <div class="col-sm-2"></div>
                                            <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                                            <div class="col-sm-3">
                                                <span type="text"
                                                    class="form-control form-control-border disabled-input"
                                                    name="kategori_wo" value="">{{ $workorders->kategori_wo }}
                                                </span>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="tgl" class="col-sm-2 col-form-label">Tanggal WO</label>
                                            <div class="col-sm-3">
                                                <span class="form-control form-control-border disabled-input"
                                                    name="tgl_dibuat">{{ $workorders->wo_create }} </span>


                                            </div>
                                            <div class="col-sm-2"></div>
                                            @if ($workorders->kategori_wo == 'hardware')
                                                <label for="jenis" class="col-sm-2 col-form-label" id="jenis_label">
                                                    Perangkat
                                                </label>
                                                <div class="col-sm-3">

                                                    <span class="form-control form-control-border" name="perangkat_id">
                                                        {{ getNamePerangkat($workorders->perangkat_id) }}
                                                    </span>

                                                </div>
                                            @endif


                                        </div>
                                        <hr>

                                        {{-- <h5 class="text-bold mt-5">Uraian Masalah :</h5> --}}

                                        <div class="form-group row">
                                            <label for="obyek" class="col-sm-2 col-form-label">Obyek</label>
                                            <div class="col-sm-10">
                                                <span type="text"
                                                    class="form-control form-control form-control-border disabled-input"
                                                    name="obyek" id="obyek"
                                                    value="">{{ $workorders->obyek }} </span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="keadaan" class="col-sm-2 col-form-label">Informasi Keluhan /
                                                Permintaan</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control disabled-input" name="keadaan" rows="4" cols="82" style="resize: none;"
                                                    readonly>{{ $workorders->keadaan }}</textarea>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="gambar" class="col-sm-2 col-form-label">Lampiran</label>
                                            <div class="col-sm-10">
                                                @if ($lampiran && file_exists(public_path($lampiran)))
                                                    <a href="{{ asset($lampiran) }}" target="_blank" class="zoom-image">
                                                        <img src="{{ asset($lampiran) }}" alt="Lampiran"
                                                            class="gambar-kecil">
                                                    </a>
                                                @else
                                                    <p>Tidak ada lampiran</p>
                                                @endif
                                            </div>
                                        </div>
                                        <h6>(Dibuat Oleh: {{ getFullName($workorders->user_id) }})</h6>

                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->

                        </div>
                        @if ($workorders->status >= 2)

                            <div class="d-flex justify-content-center">
                                <div class="card card-secondary card-outline col-12 col-md-10">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h3 class="card-title font-weight-bold">Form Perbaikan</h3>
                                            <div class="ml-auto">
                                                <button class="btn btn-link btn-toggle-collapse" type="button"
                                                    data-toggle="collapse" data-target="#collapseCard2"
                                                    aria-expanded="false" aria-controls="collapseCard">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="collapse show" id="collapseCard2">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="tgl" class="col-sm-2 col-form-label">Target
                                                    Selesai</label>
                                                <div class="col-sm-3">
                                                    <span type="text"
                                                        class="form-control form-control-border disabled-input"
                                                        name="tgl_dibuat" value="">{{ $workorders->date_end }}
                                                    </span>
                                                </div>
                                                <div class="col-2"></div>
                                                <label for="tgl" class="col-sm-2 col-form-label">Aktual
                                                    Selesai</label>
                                                <div class="col-sm-3">
                                                    <span type="text"
                                                        class="form-control form-control-border disabled-input"
                                                        name="tgl_dibuat" value="">{{ $workorders->actual }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <label for="analisa" class="col-sm-2 col-form-label">Analisa
                                                    Kerusakan</label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control " name="analisa" rows="2" cols="42" placeholder="Analisa Kerusakan "
                                                        disabled> {{ $workorders->analisa }}</textarea>

                                                </div>

                                                <label for="tindakan" class="col-sm-2 col-form-label">Tindakan Perbaikan /
                                                    Detail
                                                    Penanganan</label>
                                                <div class="col-sm-10 mt-2">
                                                    <textarea class="form-control " name="tindakan" rows="4" cols="82" placeholder="Tindakan Perbaikan"
                                                        disabled> {{ $workorders->tindakan }}</textarea>

                                                </div>
                                            </div>
                                            <hr>

                                            @if ($workorders->status == 3 && getUserDept() == 'EDP')
                                                <div
                                                    class="bg-danger rounded d-flex align-items-center justify-content-center">
                                                    <span class="text-white fw-bold fs-10">Suku Cadang / sparepart yang
                                                        digunakan</span>
                                                </div>
                                                <table class="table table-bordered text-center pb-2" id="items_table">
                                                    <tr>
                                                        <th>Nama Sparepart </th>
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
                                                            {{-- <select class="form-control select2" name="part[]"
                                                                style="width: 100%;" required onchange="showStok(this)">
                                                                <option value="">Pilih Sparepart</option>
                                                                @foreach ($sparepart as $part)
                                                                    <option value="{{ $part->id }}"
                                                                        data-stok="{{ $part->stok }}"
                                                                        style="text-align: left;">
                                                                        {{ $part->nama_sparepart }}
                                                                    </option>
                                                                @endforeach
                                                            </select> --}}

                                                        </td>
                                                        <td style="width: 200px;">
                                                            <input type="text" class="form-control" name="stok[]"
                                                                value="" disabled>
                                                        </td>

                                                        <td style="width: 200px;">
                                                            <input type="text" class="form-control" name="qty[]"
                                                                value="{{ old('qty') }}"
                                                                onkeyup="calculateTotal(this)" required>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-transparent"
                                                                onclick="addRow()"><i
                                                                    class="fas fa-plus text-primary"></i>
                                                            </button>


                                                        </td>
                                                    </tr>

                                                </table><br>
                                            @endif

                                            <h6>(Diperbaiki Oleh: {{ Auth::user()->nama_lengkap }})</h6>

                                        </div>

                                    </div>
                                </div>
                    </form>
                </div>
                <!-- /.content -->
                @endif
            </div>
    </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="path/to/jquery.js"></script>
    <script src="path/to/jquery.magnific-popup.js"></script>
    <script>
        $(document).ready(function() {
            $('.zoom-image').magnificPopup({
                type: 'image'
            });
        });
    </script>
    <script>
        var toggleButtons = document.getElementsByClassName('btn-toggle-collapse');
        for (var i = 0; i < toggleButtons.length; i++) {
            toggleButtons[i].addEventListener('click', function() {
                var icon = this.querySelector('i');
                if (icon.classList.contains('fa-plus')) {
                    icon.classList.remove('fa-plus');
                    icon.classList.add('fa-minus');
                } else {
                    icon.classList.remove('fa-minus');
                    icon.classList.add('fa-plus');
                }
            });
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    {{-- <script>
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
                '<select class="form-control item-select" name="part[]" style="width: 100%;" onchange="showStok(this)" ><option value="">Pilih Sparepart</option>@foreach ($sparepart as $part)<option value="{{ $part->id }}" data-stok="{{ $part->stok }}">{{ $part->nama_sparepart }}</option>@endforeach</select>';
            cell3.innerHTML = ' <input type="text" class="form-control" name="qty[]" onkeyup="calculateTotal(this)">';
            cell2.innerHTML =
                ' <input type="text" class="form-control" name="stok[]" value="" disabled>';
            cell4.innerHTML =
                ' <button type="button" class="btn btn-transparent" onclick="deleteRow(this)"><i class="fas fa-trash text-danger"></i></button>';

            // Menginisialisasi Select2 pada elemen select yang baru dibuat
            $('.item-select').select2();
        }

        function deleteRow(row) {
            var i = row.parentNode.parentNode.rowIndex;
            document.getElementById("items_table").deleteRow(i);
        }
    </script> --}}
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
        // Hide jenis_perangkat field and its label initially
        document.getElementById('jenis').style.display = 'none';
        document.getElementById('jenis_label').style.display = 'none';

        // Show/hide jenis_perangkat field and its label based on kategori_wo selection
        document.getElementById('kategori_wo').addEventListener('change', function() {
            var selectedCategory = this.value;
            var jenisPerangkatField = document.getElementById('jenis');
            var jenisPerangkatLabel = document.getElementById('jenis_label');

            if (selectedCategory === 'hardware') {
                jenisPerangkatField.style.display = 'block';
                jenisPerangkatLabel.style.display = 'block';
            } else {
                jenisPerangkatField.style.display = 'none';
                jenisPerangkatLabel.style.display = 'none';
            }
        });
    </script>

    <script>
        // Waktu akhir dalam format UNIX timestamp
        var endTime = new Date("{{ $workorders->date_end }}").getTime();

        // Update countdown setiap detik
        var countdownInterval = setInterval(function() {
            // Waktu saat ini
            var now = new Date().getTime();

            // Selisih waktu antara waktu saat ini dan waktu akhir
            var remainingTime = endTime - now;

            // Menghitung hari, jam, menit, dan detik
            var days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
            var hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

            // Memperbarui tampilan countdown
            document.getElementById("countdown").innerHTML = "Sisa Waktu : " +
                days + " hari " + hours + " jam " +
                minutes +
                " menit " + seconds + " detik";

            // Hentikan countdown saat waktu akhir tercapai
            if (remainingTime < 0) {
                clearInterval(countdownInterval);
                document.getElementById("countdown").innerHTML = "Batas Waktu Pengerjaan telah berakhir";
            }
        }, 1000); // Update setiap detik
    </script>
    </section>
@endsection
