@extends('layouts.mainlayout')

@section('title', 'Dashboard')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard {{ cabang() }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="Admin">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="container-fluid">
                    <!-- Info boxes -->
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Total WO</span>
                                    <span class="info-box-number">
                                        {{ $WoCount }}
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">WO Selesai</span>
                                    <span class="info-box-number"> {{ $WoDoneCount }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->

                        <!-- fix for small devices only -->
                        <div class="clearfix hidden-md-up"></div>

                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-success elevation-1"><i
                                        class="fas fa-shopping-cart"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Purchases</span>
                                    <span class="info-box-number">{{ count($purchase) }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">

                            <div class="info-box mb-3">
                                @if (getUserDept() == 'EDP')
                                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Total User</span>
                                        <span class="info-box-number">{{ $UserCount }}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                @else
                                    <span class="info-box-icon bg-warning elevation-1"><i
                                            class="fas fa-computer"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Jumlah Perangkat</span>
                                        <span class="info-box-number">{{ $Devicecount }}</span>
                                    </div>
                                @endif
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" style="margin-left: 40%">
                                Grafik
                            </h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid">
                                <div class="row">
                                    @if ((getUserCabang() == 100) & (getUserDept() == 'EDP'))
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Work Order All Cabang</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="collapse">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="remove">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="perCabang"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if (getUserDept() == 'EDP' || getUserDept() == 'BM')
                                        <div class="col-md-12">
                                            <div class="card ">
                                                <div class="card-header">
                                                    <h3 class="card-title">Work Order by Departemen</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="collapse">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="remove">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="perdepartemen"></canvas>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Data Pie Chart</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="collapse">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="remove">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div>
                                                        <label for="dataSelect">Pilih Data:</label>
                                                        <select id="dataSelect" class="form-control">
                                                            <option value="default">Data Work Order</option>
                                                            <option value="alternative1">Perbandingan Sparepart</option>
                                                            <option value="alternative2">Alternative Data 2</option>
                                                        </select>
                                                    </div>
                                                    <div class="chart mt-3">
                                                        <canvas id="pieChart"
                                                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Perangkat sering bermaslah</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="collapse">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="remove">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="chart">
                                                        <canvas id="barChart"
                                                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Aktivitas Sparepart</h3>

                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="collapse">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="remove">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body p-0">
                                                    <ul class="products-list product-list-in-card pl-2 pr-2">
                                                        @foreach ($activities->take(5) as $p)
                                                            <li class="item">
                                                                <div class="product-info">
                                                                    <a href="" class="product-title">
                                                                        @if ($p instanceof \App\Models\tambahstok)
                                                                            Sparepart Masuk ({{ $p->id_tx }})
                                                                            <span class="badge badge-success float-right">
                                                                                Rp.
                                                                                {{ number_format($p->harga * $p->qty, 0, ',', '.') }}
                                                                            </span>
                                                                        @elseif ($p instanceof \App\Models\keluarstok)
                                                                            Sparepart Keluar ({{ $p->id_tx }})
                                                                            <span class="badge badge-danger float-right">
                                                                                Rp.
                                                                                {{ number_format($p->harga * $p->qty, 0, ',', '.') }}
                                                                            </span>
                                                                        @else
                                                                            Aktivitas Tidak Diketahui
                                                                        @endif
                                                                    </a>
                                                                    <span class="product-description">
                                                                        {{ getNamesparepart($p->id_spr) }} x
                                                                        {{ $p->qty }}
                                                                    </span>
                                                                </div>
                                                            </li>
                                                        @endforeach


                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-12">
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title">Kalender</h3>
                                            </div>
                                            <div class="card-body">
                                                <!-- THE CALENDAR -->
                                                <div id="calendar" style="height: 300px;"></div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>

                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>




            </div>
    </div>

    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="/plugins/chart.js/Chart.min.js"></script>


    <!-- Page specific script -->
    <script>
        var ctx = document.getElementById('perCabang').getContext('2d');

        var chartHeight = 300;
        ctx.canvas.height = chartHeight;

        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['PDL', 'CBL', 'JTW', 'TGL', 'MDO', 'MKS', 'KDR', 'BDJ', 'BWI', 'LPG', 'DMK', 'PLM',
                    'BLI', 'PKU', 'MDN', 'LOM', 'PNK', 'LLG', 'PLU', 'KDI', 'AMQ'
                ],
                datasets: [{
                    label: 'Jumlah Work Order',
                    backgroundColor: 'lightblue',
                    borderColor: 'black',
                    data: [
                        {{ $pdl . ',' . $cbl . ',' . $jtw . ',' . $tgl . ',' . $mdo . ',' . $mks . ',' . $kdr . ',' . $bdj . ',' . $bwi . ',' . $lpg . ',' . $dmk . ',' . $plm . ',' . $bli . ',' . $pku . ',' . $mdn . ',' . $lom . ',' . $pnk . ',' . $llg . ',' . $plu . ',' . $amq . ',' . $kdi }}
                    ]
                }]
            },

            options: {
                maintainAspectRatio: false,
                responsive: true,
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
    <script>
        var ctx = document.getElementById('perdepartemen').getContext('2d');

        var chartHeight = 300;
        ctx.canvas.height = chartHeight;

        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['MKT', 'PRC', 'PBL', 'PRO', 'ENG', 'QCT', 'GPJ', 'EKS', 'KND', 'FIN', 'ACC', 'HRD', 'SIS',
                    'EDP', 'TAX', 'GRR', 'GSP', 'BM'
                ],
                datasets: [{
                    label: 'Jumlah Work Order',
                    backgroundColor: 'pink',
                    borderColor: 'black',
                    data: [
                        {{ $mkt . ',' . $prc . ',' . $pbl . ',' . $pro . ',' . $eng . ',' . $qct . ',' . $gpj . ',' . $eks . ',' . $knd . ',' . $fin . ',' . $acc . ',' . $hrd . ',' . $sis . ',' . $edp . ',' . $tax . ',' . $grr . ',' . $gsp . ',' . $bm }}
                    ]
                }]
            },

            options: {
                maintainAspectRatio: false,
                responsive: true,
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

    <script>
        $(function() {
            function ini_events(ele) {
                ele.each(function() {
                    var eventObject = {
                        title: $.trim($(this).text()),
                    };

                    $(this).data("eventObject", eventObject);
                    $(this).draggable({
                        zIndex: 1070,
                        revert: true, // will cause the event to go back to its
                        revertDuration: 0, //  original position after the drag
                    });
                });
            }

            ini_events($("#external-events div.external-event"));

            /* initialize the calendar
              -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date();
            var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear();

            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;

            var containerEl = document.getElementById("external-events");
            var checkbox = document.getElementById("drop-remove");
            var calendarEl = document.getElementById("calendar");

            var calendar = new Calendar(calendarEl, {
                headerToolbar: {
                    left: "prev,next today",
                    center: "title",
                    right: "dayGridMonth,timeGridWeek,timeGridDay",
                },
                themeSystem: "bootstrap",
                events: [
                    @foreach ($Wo as $d)
                        {
                            title: "{{ $d->no_wo . ' - ' . $d->kategori_wo }}",
                            start: new Date({{ $d->formatted_date_start }}),
                            end: {{ $d->formatted_date_end !== false ? 'new Date(' . $d->formatted_date_end . ')' : 'false' }},
                            backgroundColor: "{!! getStatusColor($d->status) !!}",
                            borderColor: 'white',
                            allDay: true,
                            url: "{{ route('Workorder_detail', ['id' => $d->id]) }}",
                            style: {
                                fontSize: '16px',
                                padding: '100px',
                            }
                        },
                    @endforeach
                    @foreach ($items as $i)
                        {
                            title: "{{ 'Barang Keluar ' . $i->id_tx }}",
                            start: new Date(
                                "{{ \Carbon\Carbon::parse($i->tgl_permintaan)->format('Y-m-d\TH:i:s') }}"
                            ),
                            backgroundColor: "#FF3F3F",
                            borderColor: 'white',
                            allDay: true,
                            url: "{{ route('detailrequest_sparepart', ['id' => $i->id]) }}",
                            style: {
                                fontSize: '16px',
                                padding: '100px',
                            }
                        },
                    @endforeach
                ],

                editable: true,
                droppable: true, // this allows things to be dropped onto the calendar !!!
                drop: function(info) {
                    // is the "remove after drop" checkbox checked?
                    if (checkbox.checked) {
                        // if so, remove the element from the "Draggable Events" list
                        info.draggedEl.parentNode.removeChild(info.draggedEl);
                    }
                },
            });

            calendar.render();
            // $('#calendar').fullCalendar()

            /* ADDING EVENTS */
            calendarEl.style.height = "700px"; // Sesuaikan dengan tinggi yang diinginkan
            var currColor = "#3c8dbc"; //Red by default
            // Color chooser button
            $("#color-chooser > li > a").click(function(e) {
                e.preventDefault();
                // Save color
                currColor = $(this).css("color");
                // Add color effect to button
                $("#add-new-event").css({
                    "background-color": currColor,
                    "border-color": currColor,
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var barChartCanvas = $('#barChart').get(0).getContext('2d');

            var barChartData = {
                labels: [
                    @foreach ($wocountbydevice as $count)
                        {{ $count->perangkat_id }},
                    @endforeach
                ],
                datasets: [{
                    label: 'Data',
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12'],
                    borderColor: ['#f56954', '#00a65a', '#f39c12'],
                    borderWidth: 1,
                    data: [
                        @foreach ($wocountbydevice as $count)
                            {{ $count->total }},
                        @endforeach
                    ],
                }]
            };


            var barChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: false,
                },
                scales: {
                    xAxes: [{
                        barPercentage: 0.5,
                        categoryPercentage: 0.5,
                        gridLines: {
                            display: false,
                        },
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false,
                        },
                    }],
                },
            };

            var barChart = new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions,
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
            var defaultData = {
                labels: ['Draft', 'confirm', 'On Proses', 'Menunggu Validasi Selesai', 'selesai'],
                datasets: [{
                    data: [
                        {{ $draft . ',' . $confirm . ',' . $Onproses . ',' . $validasi . ',' . $selesai }}
                    ],
                    backgroundColor: ['#f56954', '#05c041s', '#00c0ef', '#f39c12', '#00a65a'],
                }]
            };

            var alternativeData1 = {
                labels: ['Pembelian', 'Pengeluaran'],
                datasets: [{
                    data: [{{ $pembelian . ',' . $pengeluaran }}],
                    backgroundColor: ['#00a65a', '#cc3300', '#339966', '#663399'],
                }]
            };

            var alternativeData2 = {
                labels: ['Option 2A', 'Option 2B', 'Option 2C', 'Option 2D'],
                datasets: [{
                    data: [10, 40, 20, 30],
                    backgroundColor: ['#ff9900', '#009900', '#ff6666', '#3366cc'],
                }]
            };

            var pieChart = new Chart(pieChartCanvas, {
                type: 'pie',
                data: defaultData,
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    legend: {
                        display: true,
                        position: 'right',
                    },
                }
            });

            $('#dataSelect').change(function() {
                var selectedData = $(this).val();
                var newData;

                switch (selectedData) {
                    case 'alternative1':
                        newData = alternativeData1;
                        break;
                    case 'alternative2':
                        newData = alternativeData2;
                        break;
                    default:
                        newData = defaultData;
                }

                updateChart(newData);
            });

            function updateChart(newData) {
                pieChart.data = newData;
                pieChart.update();
            }
        });
    </script>
@endsection
