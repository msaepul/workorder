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
                                            <p class="card-text">
                                            <div class="row g-0">
                                                <div class="col-md-4 gradient-custom text-center text-white"
                                                    style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                                                        alt="Avatar" class="img-fluid my-5" style="width: 80px;" />
                                                    <h5>Marie Horwitz</h5>
                                                    <p>Web Designer</p>
                                                    <a href="#!" class="btn btn-primary"><i class="far fa-edit"></i>
                                                        Edit</a>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body p-4">
                                                        <h6>Information</h6>
                                                        <hr class="mt-0 mb-4">
                                                        <div class="row pt-1">
                                                            <div class="col-6 mb-3">
                                                                <h6>Email</h6>
                                                                <p class="text-muted">info@example.com</p>
                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <h6>Phone</h6>
                                                                <p class="text-muted">123 456 789</p>
                                                            </div>
                                                        </div>
                                                        <h6>Projects</h6>
                                                        <hr class="mt-0 mb-4">
                                                        <div class="row pt-1">
                                                            <div class="col-6 mb-3">
                                                                <h6>Recent</h6>
                                                                <p class="text-muted">Lorem ipsum</p>
                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <h6>Most Viewed</h6>
                                                                <p class="text-muted">Dolor sit amet</p>
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
                                            <p class="card-text">
                                            <div class="row g-0">
                                                <div class="col-md-12">
                                                    <div class="card-body p-4">
                                                        <h6>Information</h6>
                                                        <hr class="mt-0 mb-4">
                                                        <div class="row pt-1">
                                                            <div class="col-6 mb-3">
                                                                <h6>Email</h6>
                                                                <p class="text-muted">info@example.com</p>
                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <h6>Phone</h6>
                                                                <p class="text-muted">123 456 789</p>
                                                            </div>
                                                        </div>
                                                        <h6>Projects</h6>
                                                        <hr class="mt-0 mb-4">
                                                        <div class="row pt-1">
                                                            <div class="col-6 mb-3">
                                                                <h6>Recent</h6>
                                                                <p class="text-muted">Lorem ipsum</p>
                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <h6>Most Viewed</h6>
                                                                <p class="text-muted">Dolor sit amet</p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-start">
                                                            <a href="#!"><i
                                                                    class="fab fa-facebook-f fa-lg me-3"></i></a>
                                                            <a href="#!"><i
                                                                    class="fab fa-twitter fa-lg me-3"></i></a>
                                                            <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </p>
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
