@extends('layouts.mainlayout')

@section('title', 'Edit Perangkat')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User Profile</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="card card-primary card-outline">

                                <div class="list-group" id="myTab" role="tablist">
                                    <a class="list-group-item list-group-item-action active" id="tab1-tab"
                                        data-toggle="list" href="#tab1" role="tab" aria-controls="tab1"
                                        aria-selected="true">Profile & Data Perangkat</a>
                                    <a class="list-group-item list-group-item-action" id="tab3-tab" data-toggle="list"
                                        href="#tab3" role="tab" aria-controls="tab3" aria-selected="false">History
                                        Permintaan</a>
                                    <a class="list-group-item list-group-item-action" id="tab4-tab" data-toggle="list"
                                        href="#tab4" role="tab" aria-controls="tab4" aria-selected="false">History
                                        perbaikan</a>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="tab1" role="tabpanel"
                                    aria-labelledby="tab1-tab">
                                    <div class="card card-primary card-outline">
                                        <div class="card-body">
                                            <p class="card-text">
                                            <div class="row g-0">
                                                <div class="col-md-4 gradient-custom text-center text-white"
                                                    style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                                                        alt="Avatar" class="img-fluid my-5" style="width: 80px;" />


                                                    <h5>{{ Auth::user()->nama_lengkap }}</h5>
                                                    <p>{{ Auth::user()->dept }}</p>
                                                    <a href="#!" class="btn btn-primary"><i class="far fa-edit"></i>
                                                        Edit</a>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body p-4">
                                                        <h6>Informasi Pribadi</h6>
                                                        <hr class="mt-0 mb-4">
                                                        <div class="row pt-1">
                                                            <div class="col-6 mb-3">
                                                                <h6>Email</h6>
                                                                <p class="text-muted">{{ Auth::user()->email }}</p>
                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <h6>Cabang</h6>
                                                                <p class="text-muted">{{ cabang() }}</p>
                                                            </div>
                                                        </div>
                                                        <h6>Data Perangkat</h6>
                                                        <hr class="mt-0 mb-4">

                                                        <div class="row pt-1">
                                                            <div class="col-6 mb-3">
                                                                <h6>CPU</h6>

                                                                @foreach ($perangkatcpu as $cpu)
                                                                    <p class="text-muted">{{ $cpu->nama_perangkat }}</p>
                                                                @endforeach

                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <h6>Monitor</h6>
                                                                @foreach ($perangkatmon as $mon)
                                                                    <p class="text-muted">{{ $mon->nama_perangkat }}</p>
                                                                @endforeach

                                                                @if ($perangkatmon->isEmpty())
                                                                    <p class="text-muted">-</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row pt-1">
                                                            <div class="col-6 mb-3">
                                                                <h6>UPS</h6>
                                                                @foreach ($perangkatups as $ups)
                                                                    <p class="text-muted">{{ $ups->nama_perangkat }}</p>
                                                                @endforeach

                                                                @if ($perangkatups->isEmpty())
                                                                    <p class="text-muted">-</p>
                                                                @endif
                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <h6>Printer</h6>
                                                                @foreach ($perangkatprt as $prt)
                                                                    <p class="text-muted">{{ $prt->nama_perangkat }}</p>
                                                                @endforeach

                                                                @if ($perangkatprt->isEmpty())
                                                                    <p class="text-muted">-</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-start">
                                                            <a href="#!"><i
                                                                    class="fab fa-facebook-f fa-lg me-3"></i></a>
                                                            <a href="#!"><i class="fab fa-twitter fa-lg me-3"></i></a>
                                                            <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </p>
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                                    <div class="card card-primary card-outline">
                                        <div class="card-head"></div>
                                        <div class="card-body">
                                            <p class="card-text">

                                            <div class="col-md-12">
                                                <div class="card-body">
                                                    <center>
                                                        <h6 class="bold">Data Permintaan Sparepart</h6>
                                                    </center>
                                                    <hr class="mt-0 mb-4">
                                                    <div class="table-responsive">
                                                        <table id="tablehistory"
                                                            class="table table-bordered table-striped">
                                                            <thead class="garis-bawah">
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>ID Transaksi</th>
                                                                    <th>Nama Sparepart</th>
                                                                    <th>Qty</th>
                                                                    <th>Tgl Permintaan</th>
                                                                    <th>Keterangan</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($hisparepart as $his)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>{{ $his->id_tx }}</td>
                                                                        <td>{{ $his->nama_sparepart }}</td>
                                                                        <td>{{ $his->qty }}</td>
                                                                        <td>{{ $his->created_at->format('d/m/Y') }}</td>
                                                                        <td>{{ $his->keterangan }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">
                                    <div class="card card-primary card-outline">
                                        <div class="card-body">
                                            <h5 class="card-title">Tab 4</h5>
                                            <p class="card-text">Ini adalah isi dari Tab 4.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <style>
        /* Menghilangkan garis pada tabel */
        .table-bordered,
        .dataTable.table-bordered>tr>th,
        .dataTable.table-bordered>tbody>tr>td {
            border: none;
        }

        thead {
            border-bottom: 1px solid black;
        }

        .garis-bawah {
            border-bottom: 1px solid black;
        }

        /* Efek hover */
        .table-striped tbody tr:hover {
            background-color: #ffffff;
        }
    </style>

    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.2/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tablehistory').DataTable({
                responsive: true
            });
        });
    </script>
@endsection
