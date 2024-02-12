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
                        <h1>Edit User</h1>
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
                            <h3 class="card-title">Ubah Data User {{ ucwords(strtolower($nama_lengkap)) }} </h3>
                        </div>

                        <form method="POST" action="{{ route('user.update', ['id' => $utama->id]) }}">
                            @csrf
                            @method('PUT')
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
                            @csrf

                            <input type="hidden" name="id" value="{{ $id }}">
                            <input type="hidden" name="level" value="{{ $level }}">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-1 col-form-label">Nama</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control form-control-border" name="nama_lengkap"
                                            value="{{ $nama_lengkap }}">
                                    </div>
                                    <label for="dept" class="col-sm-1 col-form-label">Dept</label>
                                    <div class="col-sm-3">
                                        <select name="dept" class="form-control form-control-border">
                                            @foreach ($dataDept as $d)
                                                <option value="{{ $d->dept }}"
                                                    @if ($d->dept == $dept) selected @endif>
                                                    {{ $d->dept }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label for="gender" class="col-sm-1 col-form-label">Gender</label>
                                    <div class="col-sm-3">
                                        <select name="gender" class="form-control form-control-border">
                                            <option value="0" @if ($d->gender == 1) selected @endif>Laki -
                                                Laki
                                            </option>
                                            <option value="1" @if ($d->gender == 0) selected @endif>
                                                Perempuan
                                            </option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="cabang" class="col-sm-1 col-form-label">Cabang</label>
                                    <div class="col-sm-3">
                                        <select name="cabang" id="cabang"
                                            class="form-control @error('cabang') is-invalid @enderror
                                    form-control-border"
                                            required>
                                            <option value="" selected disabled>.....</option>
                                            @foreach ($dataCabang as $c)
                                                <option value="{{ $c->id }}"
                                                    @if ($cabang == $c->id) selected @endif>
                                                    {{ $c->cabang }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label for="birth_date" class="col-sm-1 col-form-label">Tgl Lahir</label>
                                    <div class="col-sm-3">
                                        <input type="date" name="birth_date" class="form-control form-control-border"
                                            value="{{ $birth_date }}">
                                    </div>
                                    <label for="no_wa" class="col-sm-1 col-form-label">No WA</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="no_wa" class="form-control form-control-border"
                                            value="{{ $no_wa }}">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="email" class="col-sm-1 col-form-label">E-mail</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="email" class="form-control form-control-border"
                                            value="{{ $email }}">
                                    </div>
                                    <label for="twitter" class="col-sm-1 col-form-label">Twitter</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="twitter" class="form-control form-control-border"
                                            value="{{ $twitter }}">
                                    </div>
                                    <label for="instagram" class="col-sm-1 col-form-label">Instagram</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="instagram" class="form-control form-control-border"
                                            value="{{ $instagram }}">
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <center>
                                    <button type="submit" class="btn btn-info">Simpan</button>
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                </center>
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
