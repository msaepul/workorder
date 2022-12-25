@extends('layouts.mainlayout')
@extends('layouts.side')

@section('title', 'Buat WO')


@section('content')
    <section class="content-header" style="margin-top: -3%; margin-bottom: -1%;">
        {{-- <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Buat PTPP Eksternal</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ '/layout/home' }}">Home</a></li>
                    <li class="breadcrumb-item active">Buat PTPP</li>
                </ol>
            </div>
        </div>
    </div> --}}

    </section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Permintaan Tindakan Perbaikan dan Pencegahan</h3>
                    </div>
                    <form enctype="multipart/form-data" class="form-horizontal" style="zoom: 80%" method="POST"
                        action="">


                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="nomor" class="col-sm-2 col-form-label">Nomor PTPP</label>
                                <div class="col-sm-3">
                                    <span
                                        class="form-control @error('nomor') is-invalid @enderror
                                    form-control-border">
                                        123131414
                                    </span>
                                    <input type="hidden" name="nomor" value="1231313">
                                    <input type="hidden" name="jenis" value="internal">
                                </div>
                                <div class="col-sm-2">
                                </div>
                                <label for="kategori" class="col-sm-2 col-form-label">Kategori PTPP</label>
                                <div class="col-sm-3">
                                    <select
                                        class="form-control @error('kategori') is-invalid @enderror
                                    form-control-border"
                                        name="kategori" id="kategori">
                                        <option value="" selected disabled> ----- </option>

                                        <option value="asdasd" selected>

                                        </option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tgl" class="col-sm-2 col-form-label">Tanggal PTPP</label>
                                <div class="col-sm-3">
                                    <span class="form-control form-control-border">
                                        123131313131 </span>
                                    <input type="hidden" name="tgl" value="1213131313">
                                    <input type="hidden" name="bulan" value="12123131">
                                </div>
                                <div class="col-sm-2">
                                </div>
                                <label for="kategori" class="col-sm-2 col-form-label">Sub Kategori PTPP</label>
                                <div class="col-sm-3">
                                    <select class="form-control form-control-border" name="subkategori" id="subkategori">
                                        <option value="" selected disabled> ----- </option>

                                        <option value="qwqsfsf" selected required>

                                        </option>


                                        <option value="asfasfsaf" selected required>

                                        </option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="d_dept" class="col-sm-2 col-form-label">Dari</label>
                                <div class="col-sm-3">
                                    <span class="form-control @error('d_dept') is-invalid @enderror form-control-border">
                                        {{ Auth::user()->dept }}</span>
                                    <input type="hidden" name="d_dept" id="d_dept" value="{{ Auth::user()->dept }}">
                                    <input type="hidden" name="dari" id="dari" value="{{ Auth::user()->cabang }}">
                                    <input type="hidden" name="kepada" id="kepada" value="{{ Auth::user()->cabang }}">
                                </div>

                                <div class="col-sm-2">
                                </div>

                                <label for="d_dept" class="col-sm-2 col-form-label">Kepada</label>
                                <div class="col-sm-3">
                                    <select type="text"
                                        class="form-control @error('k_dept') is-invalid @enderror
                                    form-control-border"
                                        name="k_dept" id="k_dept">
                                        <option disabled selected>...</option>

                                        <option value="MKT" selected>
                                        </option>

                                    </select>
                                </div>
                            </div>

                            <h5 class="text-bold mt-5">Uraian Ketidaksesuaian :</h5>
                            <div class="form-group row">
                                <label for="lokasi" class="col-sm-2 col-form-label">Lokasi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('lokasi') is-invalid @enderror"
                                        name="lokasi" id="lokasi" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="obyek" class="col-sm-2 col-form-label">Obyek</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('obyek') is-invalid @enderror"
                                        name="obyek" id="obyek" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="keadaan" class="col-sm-2 col-form-label">Keadaan</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control @error('keadaan') is-invalid @enderror" name="keadaan" rows="4" cols="82"
                                        style="resize: none;">KEADAAN</textarea>
                                </div>
                            </div>
                            <h6>(Dibuat Oleh: {{ Auth::user()->nama_lengkap }})</h6>
                            <input type="hidden" name="dibuat" value="{{ Auth::user()->nama_lengkap }}">
                            <input type="hidden" name="id_buat" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="randlink" value="">


                            <h5 class="text-bold mt-4">Analisa Penyebab Ketidaksesuaian (gunakan metode 5 why) :</h5>


                            <h6 class="mt-4">(Dianalisa Oleh : ..... )</h6>


                            <h5 class="text-bold mt-4">Tindakan Perbaikan dan Pencegahan :</h5>


                            <h6 class="mt-4">(PIC : ..... )</h6>

                            <div class="form-group row mt-4">
                                <label for="target_selesai" class="col-sm-2 col-form-label">Target Selesai</label>
                                <div class="col-sm-3">
                                    <span class="form-control @error('target') is-invalid @enderror form-control-border">
                                        ..... </span>
                                </div>
                            </div>
                        </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Lampiran</h3>
                    </div>
                    <div class="card-body">
                        <div class="dz-message mt-2">
                            <em class="ml-4">Catatan : </em><br>
                            <em class="ml-4">1. Ukuran maksimal setiap file = 2Mb (Total 10Mb)</em><br>
                            <em class="ml-4">2. Maksimal File yang dipilih = 5 file </em><br>
                            <em class="ml-4">3. Jenis file yang diperbolehkan : </em><br>
                            <em class="ml-5">a. Gambar (jpg, png, jpeg), </em><br>
                            <em class="ml-5">b. Video (3Gp, Mp4, Mkv), </em><br>
                            <em class="ml-5">c. Document (PDF). </em><br>
                        </div>

                        <div class="form-group row mt-4">
                            <label for="lampiran1" class="col-sm-2 col-form-label">Lampiran 1</label>
                            <div class="custom-file col-sm-10">
                                <input type="file" class="custom-file-input" id="lampiran1" name="lampiran1"
                                    accept="image/*,video/*,.pdf">
                                <label class="custom-file-label" for="lampiran1">Upload Lampiran Ke-1</label>
                                @error('lampiran1')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lampiran2" class="col-sm-2 col-form-label">Lampiran 2</label>
                            <div class="custom-file col-sm-10">
                                <input type="file" class="custom-file-input" id="lampiran2" name="lampiran2"
                                    accept="image/*,video/*,.pdf">
                                <label class="custom-file-label" for="lampiran2">Upload Lampiran Ke-2</label>
                                @error('lampiran2')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lampiran3" class="col-sm-2 col-form-label">Lampiran 3</label>
                            <div class="custom-file col-sm-10">
                                <input type="file" class="custom-file-input" id="lampiran3" name="lampiran3"
                                    accept="image/*,video/*,.pdf">
                                <label class="custom-file-label" for="lampiran3">Upload Lampiran Ke-3</label>
                                @error('lampiran3')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lampiran4" class="col-sm-2 col-form-label">Lampiran 4</label>
                            <div class="custom-file col-sm-10">
                                <input type="file" class="custom-file-input" id="lampiran4" name="lampiran4"
                                    accept="image/*,video/*,.pdf">
                                <label class="custom-file-label" for="lampiran4">Upload Lampiran Ke-4</label>
                                @error('lampiran4')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lampiran5" class="col-sm-2 col-form-label">Lampiran 5</label>
                            <div class="custom-file col-sm-10">
                                <input type="file" class="custom-file-input" id="lampiran5" name="lampiran5"
                                    accept="image/*,video/*,.pdf">
                                <label class="custom-file-label" for="lampiran5">Upload Lampiran Ke-5</label>
                                @error('lampiran5')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <center>
                            <button type="submit" class="btn btn-info">Simpan</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </center>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
