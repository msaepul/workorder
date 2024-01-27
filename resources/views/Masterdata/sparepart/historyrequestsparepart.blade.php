@extends('layouts.mainlayout')

@section('title', ' History Permintaan')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            History Permintaan
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Modals & Alerts</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('request_sparepart') }}" type="button" class="btn btn-primary">
                                    <i class="nav-icon fas fa-plus"></i> Minta Sparepart
                                </a>

                            </div>
                            {{-- @include('Masterdata.perangkat.modaladdperangkat') --}}

                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                @if (session('success'))
                                    <div id="success-alert" class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <script>
                                    setTimeout(function() {
                                        document.getElementById('success-alert').style.display = 'none';
                                    }, 5000);
                                </script>
                                <table id="example" class="display" cellspacing="0" width="100%">

                                    <thead class="">
                                        <tr>
                                            {{-- <th rowspan="2" class="align-middle text-center">No</th> --}}
                                            <th rowspan="2" class="align-middle text-center">No Transaksi</th>
                                            <th colspan="2" class="text-center">Rincian Sparepart</th>
                                            <th rowspan="2" class="align-middle text-center">Nama User</th>
                                            <th rowspan="2" class="align-middle text-center">Status</th>
                                            <th rowspan="2" class="align-middle text-center">Detail</th>
                                        </tr>
                                        <tr>
                                            <th class="align-middle text-center">Nama</th>
                                            <th class="align-middle text-center">Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($groupedHistory as $idTx => $items)
                                            @foreach ($items as $index => $item)
                                                <tr>
                                                    @if ($index === 0)
                                                        <td rowspan="{{ count($items) }}" class="align-middle text-center">
                                                            {{ $idTx }}</td>
                                                    @endif
                                                    <td class="text-left">{{ getNamesparepart($item->id_spr) }}</td>
                                                    <td class="text-center">{{ $item->qty }}</td>
                                                    @if ($index === 0)
                                                        <td rowspan="{{ count($items) }}" class="align-middle text-center">
                                                            {{ getFullName($item->user_id) }}</td>
                                                        <td rowspan="{{ count($items) }}" class="align-middle text-center">
                                                            @if ($item->status == 0)
                                                                <button class="btn btn-danger btn-xs">Cancel</button>
                                                            @elseif ($item->status == 1)
                                                                <button class="btn btn-secondary btn-xs">Draft</button>
                                                            @elseif ($item->status == 2)
                                                                <button class="btn btn-primary btn-xs">Confirm</button>
                                                            @elseif ($item->status == 3 || $item->status == 4)
                                                                <button class="btn btn-success btn-xs">Done</button>
                                                            @endif

                                                        </td>

                                                        <td rowspan="{{ count($items) }}" class="align-middle text-center">
                                                            <a href="{{ route('detailrequest_sparepart', $item->id) }}"
                                                                class="btn btn-primary">Detail</a>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @endforeach

                                    </tbody>

                                </table>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <!-- /.content -->
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                // 'ajax': 'https://gyrocode.github.io/files/jquery-datatables/arrays.json',
                'rowsGroup': [2]
            });
        });
    </script>

@endsection
