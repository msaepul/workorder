@extends('layouts.mainlayout')

@section('title', 'Detail_Wo')

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
            <form action="{{ route('Workorder_proses') }}" method="post" enctype="multipart/form-data">
                @csrf
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
                                        <a href="" class="btn btn-primary mr-2">Confirm</a>
                                        <a href="" class="btn btn-secondary">Cancel</a>
                                    </div>
                                    <div class="right-status">
                                        <div class="status-container">
                                            <div class="box bg-primary">
                                                <span class="status">Draft</span>
                                            </div>
                                            <div class="arrow"></div>
                                        </div>
                                        <div class="status-container">
                                            <div class="box">
                                                <span class="status">Confirm</span>
                                            </div>
                                            <div class="arrow"></div>
                                        </div>
                                        <div class="status-container">
                                            <div class="box">
                                                <span class="status">On Progress</span>
                                            </div>
                                            <div class="arrow"></div>
                                        </div>
                                        <div class="status-container">
                                            <div class="box">
                                                <span class="status">Done</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>



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
                                            <input type="text" class="form-control form-control-border" name="no_wo"
                                                value="{{ $no }}">
                                        </div>
                                        <div class="col-sm-2"></div>
                                        <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                                        <div class="col-sm-3">
                                            <select class="form-control form-control-border" name="kategori_wo"
                                                id="kategori_wo">
                                                <option value="" selected disabled>-----</option>
                                                <option value="perbaikan">Perbaikan</option>
                                                <option value="perbantuan">Perbantuan/penambahan</option>
                                                <option value="proyek">Proyek Baru</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="tgl" class="col-sm-2 col-form-label">Tanggal WO</label>
                                        <div class="col-sm-3">
                                            <input type="datetime-local" class="form-control form-control-border"
                                                name="tgl_dibuat" id="tgl_dibuat" required>


                                        </div>
                                        <div class="col-sm-2"></div>
                                        <label for="jenis" class="col-sm-2 col-form-label" id="jenis_label">
                                            Perangkat</label>
                                        <div class="col-sm-3">
                                            <select class="form-control form-control-border" name="perangkat_id"
                                                id="jenis">
                                                @foreach ($listperangkat as $list)
                                                    <option value="{{ $list->id }}"
                                                        @if (old('list_id') == $list->id) selected @endif>
                                                        {{ $list->nama_perangkat }}
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <hr>

                                    {{-- <h5 class="text-bold mt-5">Uraian Masalah :</h5> --}}

                                    <div class="form-group row">
                                        <label for="obyek" class="col-sm-2 col-form-label">Obyek</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('obyek') is-invalid @enderror"
                                                name="obyek" id="obyek" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="keadaan" class="col-sm-2 col-form-label">Informasi Keluhan /
                                            Permintaan</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control @error('keadaan') is-invalid @enderror" name="keadaan" rows="4" cols="82"
                                                style="resize: none;"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control-file" name="gambar"
                                                id="gambar">
                                        </div>
                                    </div>
                                    <h6>(Dibuat Oleh: {{ Auth::user()->nama_lengkap }})</h6>
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="randlink" value="">
                                </div>

                                <div class="card-footer">
                                    <center>
                                        <button type="submit" class="btn btn-info">Simpan</button>
                                        <button type="reset" class="btn btn-danger">Reset</button>
                                    </center>
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

            if (selectedCategory === 'perbaikan') {
                jenisPerangkatField.style.display = 'block';
                jenisPerangkatLabel.style.display = 'block';
            } else {
                jenisPerangkatField.style.display = 'none';
                jenisPerangkatLabel.style.display = 'none';
            }
        });
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
@endsection
