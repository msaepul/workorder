@extends('layouts.mainlayout')

@section('title', 'Add User')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">User</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-navy">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah User</h3>
                        </div>
                        <form enctype="multipart/form-data" class="form-horizontal" style="zoom: 80%" autocomplete="off"
                            method="POST" action="{{ route('user_proses') }}">
                            @if (session()->has('errors'))
                                @foreach ($errors->all() as $err)
                                    <div class="alert alert-danger alert dismissible fade show" role="alert"
                                        id="danger-alert">
                                        <strong>{{ $err }}
                                        </strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endforeach
                            @endif
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ session('success') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @csrf

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="dept">Departemen</label>
                                                <select name="dept" id="dept"
                                                    class="form-control @error('dept') is-invalid @enderror
                                            form-control-border"
                                                    required>
                                                    <option value="" selected disabled>.....</option>
                                                    @foreach ($dataDept as $dept)
                                                        <option value="{{ $dept->dept }}"
                                                            @if (old('kategori') == $dept->dept) selected @endif>
                                                            {{ $dept->dept }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <label for="cabang">Cabang</label>
                                                <select name="cabang" id="cabang"
                                                    class="form-control @error('cabang') is-invalid @enderror
                                            form-control-border"
                                                    required>
                                                    <option value="" selected disabled>.....</option>
                                                    @foreach ($dataCabang as $cabang)
                                                        <option value="{{ $cabang->id }}"
                                                            @if (old('kategori') == $cabang->cabang) selected @endif>
                                                            {{ $cabang->cabang }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <label for="email">E-mail</label><br>
                                                <Input type="text" id="email" name="email"
                                                    class="form-control @error('email') is-invalid @enderror 
                                            form-control-border">
                                            </div>


                                            <div class="form-group">
                                                <label for="password">password</label><br>
                                                <Input type="password" id="password" name="password" value="1Roti123"
                                                    class="form-control @error('password') is-invalid @enderror
                                            form-control-border">
                                            </div>


                                            <div class="form-group">
                                                <label for="no_telegram">Nomor Telegram</label><br>
                                                <Input type="text" id="no_telegram" name="no_telegram" value="0"
                                                    class="form-control @error('no_telegram') is-invalid @enderror
                                            form-control-border">
                                            </div>


                                            <div class="form-group">
                                                <label for="no_wa">Nomor WhatsApp</label><br>
                                                <Input type="text" id="no_wa" name="no_wa" value="0"
                                                    class="form-control @error('no_wa') is-invalid @enderror
                                            form-control-border">
                                            </div>


                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="card-body">

                                            <div class="form-group">
                                                <label for="nama_lengkap">Nama Lengkap</label>
                                                <Input type="text" id="nama_lengkap" name="nama_lengkap"
                                                    class="form-control @error('nama_lengkap') is-invalid @enderror
                                            form-control-border"
                                                    required>
                                            </div>


                                            <div class="form-group">
                                                <label for="birth_date">Tanggal Lahir</label>
                                                <Input type="date" id="birth_date" name="birth_date"
                                                    class="form-control @error('birth_date') is-invalid @enderror
                                            form-control-border"
                                                    value="1988-01-23" required>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="gender">Jenis Kelamin</label><br>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="gender" id="male" value="1" checked>
                                                                <label class="form-check-label"
                                                                    for="male">Laki-laki</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="gender" id="female" value="2">
                                                                <label class="form-check-label"
                                                                    for="female">Wanita</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="twitter">Twitter</label><br>
                                                <Input type="text" id="twitter" name="twitter" value="-"
                                                    class="form-control @error('twitter') is-invalid @enderror
                                            form-control-border">
                                            </div>
                                            <div class="form-group">
                                                <label for="instagram">Instagram</label><br>
                                                <Input type="text" id="instagram" name="instagram" value="-"
                                                    class="form-control @error('instagram') is-invalid @enderror
                                            form-control-border">
                                            </div>

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
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- /.content -->
    </div>

@endsection
