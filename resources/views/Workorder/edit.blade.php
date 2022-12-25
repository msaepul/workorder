@extends('layouts.mainlayout')
@extends('layouts.side')

@section('title', 'Work Order')


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
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Work Order</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="nomor" class="col-sm-2 col-form-label">Nomor WO</label>
                                <div class="col-sm-3">
                                    <span
                                        class="form-control @error('nomor') is-invalid @enderror
                                    form-control-border">
                                        WO-PDL/22/11/001
                                    </span>
                                    <input type="hidden" name="nomor" value="1231313">
                                    <input type="hidden" name="jenis" value="internal">
                                </div>
                                <div class="col-sm-2">
                                </div>
                                <label for="kategori" class="col-sm-2 col-form-label">Kategori </label>
                                <div class="col-sm-3">
                                    <select
                                        class="form-control @error('kategori') is-invalid @enderror
                                    form-control-border"
                                        name="kategori" id="kategori">
                                        <option value="" selected disabled> ----- </option>

                                        <option value="hardware">
                                            Hardware
                                        </option>
                                        <option value="software">
                                            Software
                                        </option>
                                        <option value="brainware">
                                            Brainware
                                        </option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tgl" class="col-sm-2 col-form-label">Tanggal WO</label>
                                <div class="col-sm-3">
                                    <span class="form-control form-control-border">
                                        {{ $todayDate }} </span>
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

                            {{-- <div class="form-group row">
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
                            </div> --}}

                            <h5 class="text-bold mt-5">Uraian Masalah :</h5>
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
                            <div class="row mt-4">
                                <nav class="w-100">
                                  <div class="nav nav-tabs" id="product-tab" role="tablist" disabled>
                                    <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
                                    <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Comments</a>
                                    <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Rating</a>
                                  </div>
                                </nav>
                                <div class="tab-content p-3" id="nav-tabContent">
                                  <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae condimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed posuere, purus at efficitur hendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed rutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse mi nibh, congue et ante et, commodo mattis lacus. Duis varius finibus purus sed venenatis. Vivamus varius metus quam, id dapibus velit mattis eu. Praesent et semper risus. Vestibulum erat erat, condimentum at elit at, bibendum placerat orci. Nullam gravida velit mauris, in pellentesque urna pellentesque viverra. Nullam non pellentesque justo, et ultricies neque. Praesent vel metus rutrum, tempus erat a, rutrum ante. Quisque interdum efficitur nunc vitae consectetur. Suspendisse venenatis, tortor non convallis interdum, urna mi molestie eros, vel tempor justo lacus ac justo. Fusce id enim a erat fringilla sollicitudin ultrices vel metus. </div>
                                  <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"> Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum. </div>
                                  <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab"> Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. Donec varius massa at semper posuere. Integer finibus orci vitae vehicula placerat. </div>
                                </div>
                              </div>
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
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Lampiran</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                    title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputFile">Upload Bukti</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </section>
        <!-- /.content -->

    @endsection
