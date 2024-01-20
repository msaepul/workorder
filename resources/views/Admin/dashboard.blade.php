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
                                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Total User</span>
                                    <span class="info-box-number">{{ $UserCount }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" style="margin-left: 40%">
                                Grafik LPTS || Periode :
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

                                    <div class="col-md-12">
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h3 class="card-title">5 LPTS Berulang Tertinggi All Cabang</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="berulang"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="card card-success">
                                            <div class="card-header">
                                                <h3 class="card-title">Pie Chart</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="chart">
                                                    <canvas id="pieChart"
                                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card card-success">
                                            <div class="card-header">
                                                <h3 class="card-title">Bar Chart</h3>
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
                                                    @foreach ($activities as $p)
                                                        <li class="item">
                                                            <div class="product-info">
                                                                <a href="" class="product-title">
                                                                    @if ($p instanceof \App\Models\tambahstok)
                                                                        Sparepart Masuk ({{ $p->id_tx }})
                                                                        <span class="badge badge-success float-right">
                                                                            Rp. {{ $p->harga }}
                                                                        @elseif ($p instanceof \App\Models\keluarstok)
                                                                            Sparepart Keluar ({{ $p->id_tx }})
                                                                            <span class="badge badge-danger float-right">
                                                                                Rp. {{ $p->harga }}
                                                                            @else
                                                                                Aktivitas Tidak Diketahui
                                                                    @endif

                                                                    </span>
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
        $(document).ready(function() {
            var lineChartCanvas = $('#berulang').get(0).getContext('2d');

            var lineChartData = {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Digital Goods',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: 5,
                    pointBackgroundColor: '#3b8bba',
                    pointBorderColor: 'rgba(60,141,188,1)',
                    pointBorderWidth: 2,
                    pointHoverRadius: 8,
                    pointHoverBackgroundColor: '#3b8bba',
                    pointHoverBorderColor: 'rgba(60,141,188,1)',
                    pointHoverBorderWidth: 2,
                    pointLabelFontColor: '#000', // Warna font label titik
                    pointLabelFontSize: 12, // Ukuran font label titik
                    pointLabelFontStyle: 'bold', // Gaya font label titik
                    data: [28, 48, 40, 19, 86, 27, 90]
                }]
            };

            var lineChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: true
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false
                        }
                    }]
                }
            };

            var lineChart = new Chart(lineChartCanvas, {
                type: 'line',
                data: lineChartData,
                options: lineChartOptions
            });
        });
    </script>

    {{-- <!-- fullCalendar 2.2.5 -->
    <script src="../plugins/moment/moment.min.js"></script>
    <script src="../plugins/fullcalendar/main.js"></script> --}}

    <!-- Page specific script -->
    <script>
        $(function() {
            /* initialize the external events
              -----------------------------------------------------------------*/
            function ini_events(ele) {
                ele.each(function() {
                    // create an Event Object (https://fullcalendar.io/docs/event-object)
                    // it doesn't need to have a start or end
                    var eventObject = {
                        title: $.trim($(this).text()), // use the element's text as the event title
                    };

                    // store the Event Object in the DOM element so we can get to it later
                    $(this).data("eventObject", eventObject);

                    // make the event draggable using jQuery UI
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
                //Random default events
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
                                fontSize: '16px', // Adjust the font size as needed for the title
                                padding: '100px', // Adjust the padding to increase/decrease the box size
                                // You can add other CSS properties here
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
                                fontSize: '16px', // Adjust the font size as needed for the title
                                padding: '100px', // Adjust the padding to increase/decrease the box size
                                // You can add other CSS properties here
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
                labels: ['Category A', 'Category B', 'Category C', 'Category D'],
                datasets: [{
                    label: 'Data',
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef'],
                    borderColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef'],
                    borderWidth: 1,
                    data: [30, 25, 20, 25],
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

            var pieChartData = {
                labels: ['Category A', 'Category B', 'Category C', 'Category D'],
                datasets: [{
                    data: [30, 25, 20, 25],
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef'],
                }]
            };

            var pieChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: true,
                    position: 'right',
                },
            };

            var pieChart = new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieChartData,
                options: pieChartOptions
            });
        });
    </script>

@endsection
