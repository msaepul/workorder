@extends('layouts.mainlayout')

@section('title', 'Data Order')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Buat Work Order</h1>
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
                    <div class="d-flex justify-content-center ">
                        <div class="card card-flat col-12 col-md-10" style="height: 60px; ">
                            <div class="card-body-a d-flex align-items-center">

                                <div class="left-links">
                                    <form action="{{ route('woupdate_status', ['id' => $workorders->id]) }}" method="post">
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
                                                <a href="" class="btn btn-warning">Edit</a>
                                            @endif
                                        @elseif ($workorders->status == 2)
                                            @if (getUserDept() == 'EDP')
                                                <button type="submit" name="status" value="3"
                                                    class="btn btn-success mr-2"
                                                    onclick="return confirm('Apakah anda ingin membatalkan WO nya?')">Proses
                                                    WO</button>
                                            @endif
                                        @elseif ($workorders->status == 3)
                                            @if (getUserDept() != 'EDP')
                                                <button type="submit" name="status" value="4"
                                                    class="btn btn-success mr-2"
                                                    onclick="return confirm('Apakah anda ingin menyelesaikan WO?')">WO
                                                    Selesai</button>
                                            @endif
                                        @endif
                                    </form>

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


                    <form action="{{ route('Workorder_proses') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <!-- /.card -->
                        <div class="d-flex justify-content-center">
                            <div class="card card-secondary card-outline col-12 col-md-10">
                                <div class="card-header">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <h3 class="card-title font-weight-bold">Form Work Order</h3>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="nomor" class="col-sm-2 col-form-label">Nomor WO</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control form-control-border disabled-input"
                                                name="no_wo" value="{{ $workorders->no_wo }}">
                                        </div>
                                        <div class="col-sm-2"></div>
                                        <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control form-control-border disabled-input"
                                                name="kategori_wo" value="{{ $workorders->kategori_wo }}">

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="tgl" class="col-sm-2 col-form-label">Tanggal WO</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control form-control-border disabled-input"
                                                name="tgl_dibuat" value="{{ $workorders->wo_create }}">


                                        </div>
                                        <div class="col-sm-2"></div>
                                        <label for="jenis" class="col-sm-2 col-form-label" id="jenis_label">
                                            Perangkat</label>
                                        <div class="col-sm-3">
                                            <select class="form-control form-control-border" name="perangkat_id"
                                                id="jenis">
                                                {{-- @foreach ($listperangkat as $list)
                                                    <option value="{{ $list->id }}"
                                                        @if (old('list_id') == $list->id) selected @endif>
                                                        {{ $list->nama_perangkat }}
                                                @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                    <hr>

                                    {{-- <h5 class="text-bold mt-5">Uraian Masalah :</h5> --}}

                                    <div class="form-group row">
                                        <label for="obyek" class="col-sm-2 col-form-label">Obyek</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                class="form-control form-control form-control-border disabled-input"
                                                name="obyek" id="obyek" value="{{ $workorders->obyek }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="keadaan" class="col-sm-2 col-form-label">Informasi Keluhan /
                                            Permintaan</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control disabled-input" name="keadaan" rows="4" cols="82" style="resize: none;">{{ $workorders->keadaan }}</textarea>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
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
                                    <h6>(Dibuat Oleh: {{ Auth::user()->nama_lengkap }})</h6>
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                </div>
                <!-- /.content -->
                </form>
        </section>
    </div>
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

@endsection
