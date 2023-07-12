@extends('layouts.mainlayout')

@section('title', 'Data Order')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Detail Work Order {{ $workorders->no_wo }} </h1>
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
                                            @if (getUserDept() == 'EDP' && getDeptUser($workorders->user_id) == 'EDP')
                                                <button type="submit" name="status" value="2"
                                                    class="btn btn-success "
                                                    onclick="return confirm('Apakah anda ingin mengkonfirmasi WO nya?')"><i
                                                        class="fas fa-check" style="color: #ffffff;"></i> Confirm</button>
                                                <a href="{{ route('Workorder_edit', ['id' => $workorders->id]) }}"
                                                    class="btn btn-secondary "> <i class="nav-icon fas fa-edit"></i>
                                                    Edit</a>
                                                <button type="submit" name="status" value="0"
                                                    class="btn btn-danger mr-2"
                                                    onclick="return confirm('Apakah anda ingin membatalkan WO nya?')"><i
                                                        class="fa-solid fa-x"></i> Cancel</button>
                                            @elseif (getUserDept() == 'EDP')
                                                <button type="submit" name="status" value="0"
                                                    class="btn btn-danger mr-2"
                                                    onclick="return confirm('Apakah anda ingin membatalkan WO nya?')"><i
                                                        class="fa-solid fa-x"></i> Cancel</button>
                                            @else
                                                <button type="submit" name="status" value="2"
                                                    class="btn btn-success "
                                                    onclick="return confirm('Apakah anda ingin mengkonfirmasi WO nya?')"><i
                                                        class="fas fa-check" style="color: #ffffff;"></i> Confirm</button>
                                                <a href="{{ route('Workorder_edit', ['id' => $workorders->id]) }}"
                                                    class="btn btn-secondary "> <i class="nav-icon fas fa-edit"></i>
                                                    Edit</a>
                                            @endif
                                        @elseif ($workorders->status == 2)
                                            @if (getUserDept() == 'EDP')
                                                <button type="button" class="btn btn-success mr-2" data-toggle="modal"
                                                    data-target="#confirmModal">Proses WO</button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog"
                                                    aria-labelledby="confirmModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="confirmModalLabel">Konfirmasi
                                                                    Pengerjaan WO</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="name">Target Selesai</label>
                                                                    <input type="datetime-local" class="form-control"
                                                                        id="date_end" name="date_end"
                                                                        value="{{ old('date_end') }}">
                                                                    <input type="hidden" class="form-control"
                                                                        id="date_start" name="date_start"
                                                                        value="{{ now() }}">
                                                                    <input type="hidden" class="form-control"
                                                                        id="userfix_id" name="userfix_id"
                                                                        value="{{ getUserId() }}">
                                                                </div>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Tutup</button>
                                                                <button type="submit" name="status" value="3"
                                                                    class="btn btn-success">Konfirmasi</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="btn btn-secondary mr-2 disabled" data-toggle="modal"
                                                    data-target="#confirmModal">Menunggu EDP Mulai Mengerjakan</span>
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
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h3 class="card-title font-weight-bold">Form Work Order</h3>
                                        <div class="ml-auto">
                                            <button class="btn btn-link btn-toggle-collapse" type="button"
                                                data-toggle="collapse" data-target="#collapseCard" aria-expanded="false"
                                                aria-controls="collapseCard">
                                                <i class="fa fa-minus text-secondary"></i>
                                            </button>
                                        </div>
                                    </div>


                                </div>
                                <div class="collapse show" id="collapseCard">
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
                    </form>
        </section>
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

@endsection
