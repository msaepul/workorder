@extends('layouts.mainlayout')
@extends('layouts.side')

@section('title', 'Work Order')


@section('content')
@php
function random_str(int $length = 64, string $keyspace = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'): string
{
if ($length < 1) { throw new \RangeException('Length must be a positive integer'); } $pieces=[]; $max=mb_strlen($keyspace, '8bit' ) - 1; for ($i=0; $i < $length; ++$i) { $pieces[]=$keyspace[random_int(0, $max)]; } return implode('', $pieces); } function tgl_id($tanggal) { if ($tanggal==null) { return '-' ; } elseif ($tanggal=='' ) { return '-' ; } else { $bulan=[1=> 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
    $split = explode('-', $tanggal);
    $hasil_tgl = $bulan[(int) $split[0]];

    return $hasil_tgl;
    }
    }
    $cabang = Auth::user()->cabang->kode_cabang;
    $sdraft = 'draft' . $cabang;
    $bulan = date('F');
    $monthnow = date('m', time());
    $yearnow = date('Y', time());
    $nilaikode3 = substr($kodeMax,18);

    if ($kodeMax) {
    $nilaikode = substr($kodeMax, 18);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $beda = (int) $nilaikode + 1;
    $kodeMaxp = str_pad($kode, 3, '0', STR_PAD_LEFT);
    } else {
    $kodeMaxp = '001';
    }
    $hasilkode = 'WO - ' . $cabang . '/' . $yearnow . '/' . tgl_id($monthnow) . '/' . $kodeMaxp;
    @endphp

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Buat Work Order {{$nilaikode3}}</h1>
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
            <form action="{{route('Workorder_proses')}}" method="post">
                @csrf
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
                                        <span class="form-control @error('nomor') is-invalid @enderror
                                    form-control-border">
                                            {{$hasilkode}}
                                        </span>
                                        <input type="hidden" name="no_wo" value="{{$hasilkode}}">
                                    </div>
                                    <div class="col-sm-2">
                                    </div>
                                    <label for="kategori" class="col-sm-2 col-form-label">Kategori </label>
                                    <div class="col-sm-3">
                                        <select class="form-control @error('kategori') is-invalid @enderror form-control-border" name="kategori_wo" id="kategori_wo" onchange="disableperangkat(this)">
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
                                        <input type="hidden" name="wo_create" value=" {{ $todayDate }}">
                                    </div>
                                    <div class="col-sm-2">
                                    </div>
                                    <label for="kategori" class="col-sm-2 col-form-label">Jenis Perangkat</label>
                                    <div class="col-sm-3">
                                        <select class="form-control form-control-border" name="jenis_perangkat" id="jenis" disabled="">
                                            <option value="" selected> ----- </option>

                                            <option value="PDL/CPU/001" required>
                                                PDL/CPU/001
                                            </option>


                                            <option value="PDL/CPU/002" required>
                                                PDL/CPU/002
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
                                <select type="text" class="form-control @error('k_dept') is-invalid @enderror
                                    form-control-border" name="k_dept" id="k_dept">
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
                                <input type="text" class="form-control @error('lokasi') is-invalid @enderror" name="lokasi" id="lokasi" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="obyek" class="col-sm-2 col-form-label">Obyek</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('obyek') is-invalid @enderror" name="obyek" id="obyek" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="keadaan" class="col-sm-2 col-form-label">Keadaan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control @error('keadaan') is-invalid @enderror" name="keadaan" rows="4" cols="82" style="resize: none;"></textarea>
                            </div>
                        </div>
                        <h6>(Dibuat Oleh: {{ Auth::user()->nama_lengkap }})</h6>
                        <input type="hidden" name="dibuat" value="{{ Auth::user()->nama_lengkap }}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="randlink" value="">

                        <div class="row mt-4">
                            <nav class="w-100">
                                <div class="nav nav-tabs" id="product-tab" role="tablist" disabled>
                                    <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Deskripsi Perbaikan</a>
                                    <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Sparepart yang digunakan</a>
                                    <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Penilaian</a>
                                </div>
                            </nav>
                            <div class="tab-content p-3" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> _</div>
                                <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"> _</div>
                                <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab">_</div>
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
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
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
    <!-- /.content -->
    </form>
    </section>
    </div>


    @endsection