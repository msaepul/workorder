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
                            <div class="card">

                                <div class="list-group" id="myTab" role="tablist">
                                    <a class="list-group-item list-group-item-action active" id="tab1-tab"
                                        data-toggle="list" href="#tab1" role="tab" aria-controls="tab1"
                                        aria-selected="true">Profil</a>
                                    <a class="list-group-item list-group-item-action" id="tab2-tab" data-toggle="list"
                                        href="#tab2" role="tab" aria-controls="tab2" aria-selected="false">Data
                                        Perangkat</a>
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
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Tab 1</h5>
                                            <p class="card-text">Ini adalah isi dari Tab 1.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Tab 2</h5>
                                            <p class="card-text">Ini adalah isi dari Tab 2.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Tab 3</h5>
                                            <p class="card-text">Ini adalah isi dari Tab 3.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">
                                    <div class="card">
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
@endsection
