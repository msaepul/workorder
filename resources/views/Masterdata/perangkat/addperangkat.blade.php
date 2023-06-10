@extends('layouts.mainlayout')

@section('title', 'Work Order')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah Perangkat</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Contact us</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content center">
            <form action="{{ route('perangkat_proses') }}" method="POST">
                @csrf
                <div class="d-flex justify-content-center">
                    <!-- Default box -->
                    <div class="card card-primary card-outline col-12 col-md-8">
                        <div class="card-body">

                            <div class="form-group row pb-2">
                                <div
                                    class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                    <label for="nama_perangkat" class="text-end">Nama Perangkat</label>
                                </div>
                                <div class="col-12 col-md-7 col-sm-7">
                                    <input type="text" id="nama_perangkat" class="form-control" name="nama_perangkat" value="{{ old('nama_perangkat') }}" />
                                </div>
                            </div>
                            <div class="form-group row pb-2 ">
                                <div class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-lg-end ">
                                    <label for="jenis_perangkat" class="text-end">Jenis Perangkat</label>
                                </div>
                                <div class="col-12 col-sm-7">
                                    <input type="text" id="jenis_perangkat" class="form-control"
                                        name="jenis_perangkat" value="{{ old('jenis_perangkat') }}" />
                                </div>
                            </div>
                            <div class="form-group row pb-2 ">
                                <div
                                    class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                    <label for="nama_brand" class="text-end">Brand/merk</label>
                                </div>
                                <div class="col-12 col-sm-7">
                                    <select class="form-control" id="nama_brand" name="nama_brand" value="{{ old('nama_brand') }}">
                                        <option value="">Pilih Brand</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name_brand }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div
                                    class="col-12 col-md-2 col-sm-2 d-flex align-items-center justify-content-sm-start justify-content-lg-start">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalbrand" class="btn btn-primary">New</button>
                                </div>
                            </div>
                            <div class="form-group row pb-2 ">
                                <div
                                    class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                    <label for="nama_type" class="text-end">Type</label>
                                </div>
                                <div class="col-12 col-sm-7">
                                    <select class="form-control" id="nama_type" name="nama_type" value="{{ old('nama_type') }}">
                                        <option value="">Pilih type</option>
                                        @foreach($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div
                                    class="col-12 col-md-2 col-sm-2 d-flex align-items-center justify-content-sm-start justify-content-lg-start">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModaltype" class="btn btn-primary">New</button>
                                </div>
                            </div>
                            <div class="form-group row pb-2 ">
                                <div
                                    class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                    <label for="spesifikasi" class="text-end">Spesifikasi</label>
                                </div>
                                <div class="col-12 col-sm-7">
                                    <textarea class="form-control" id="spesifikasi" name="spesifikasi" rows="4" cols="50" value="{{ old('spesifikasi') }}"></textarea>
                                </div>
                            </div>
                            <div class="form-group row pb-2 ">
                                <div
                                    class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                    <label for="tgl_pbl" class="text-end">Tanggal Pembelian</label>
                                </div>
                                <div class="col-12 col-sm-7">
                                    <input type="date" class="form-control w-50" id="tgl_pbl" name="tgl_pbl" value="{{ old('tgl_pbl') }}">
                                </div>
                            </div>
                            <div class="form-group row pb-2 ">
                                <div
                                    class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                    <label for="user_id" class="text-end">Pengguna / Departemen</label>
                                </div>
                                <div class="col-12 col-sm-7">
                                    <select class="form-control" id="user_id" name="user_id" value="{{ old('user_id') }}">
                                        <option value="">Pilih User</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->nama_lengkap }} || {{ $user->dept}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                           
                                    <input type="hidden" class="form-control w-50" id="cabang_id" name="cabang_id" value="{{$user->cabang}}">
                                
                          
                        <div class="form-group row pb-2">
                            <div class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                
                            </div>
                            <div class="col-12 col-sm-7">
                                <label class="form-check-label">
                                    <input type="checkbox" id="optional" class="form-check-input" name="optional" value="show">
                                   <strong> Show Optional Information</strong>
                                </label>
                            </div>
                        </div>
                        
                        <div id="optional-info" style="display: none;">
                            <div class="form-group row pb-2">
                                <div class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                    <label for="ip" class="text-end">IP</label>
                                </div>
                                <div class="col-12 col-sm-7">
                                    <input type="text" id="ip" class="form-control" name="ip" />
                                </div>
                            </div>
                            <div class="form-group row pb-2">
                                <div class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                    <label for="macaddress" class="text-end">Mac address</label>
                                </div>
                                <div class="col-12 col-sm-7">
                                    <input type="text" id="macaddress" class="form-control" name="macaddress" />
                                </div>
                            </div>
                            <div class="form-group row pb-2 ">
                                <div
                                    class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                    <label for="id_teamviewer" class="text-end">ID Teamviewer</label>
                                </div>
                                <div class="col-12 col-sm-7">
                                    <input type="text" id="id_teamviewer" class="form-control" name="id_teamviewer" value="{{ old('id_teamviewer') }}" />
                                </div>
                            </div>
                            <div class="form-group row pb-2 ">
                                <div
                                    class="col-12 col-md-3 col-sm-3 d-flex align-items-center justify-content-sm-end justify-content-lg-end">
                                    <label for="id_anydesk" class="text-end">ID Anydesk</label>
                                </div>
                                <div class="col-12 col-sm-7">
                                    <input type="text" id="id_anydesk" class="form-control"  name="id_anydesk"/>
                                </div>
                            </div>
                            
                        </div>
                        
                        <script>
                            document.getElementById('optional').addEventListener('change', function() {
                                var optionalInfo = document.getElementById('optional-info');
                        
                                if (this.checked) {
                                    optionalInfo.style.display = 'block';
                                } else {
                                    optionalInfo.style.display = 'none';
                                }
                            });
                        </script>
                        
                        
                            <div class="form-group">
                                <div class="card-footer">
                                    <input type="button" class="btn btn-secondary float-start" value="Cancel">
                                    <input type="submit" class="btn btn-primary float-end" value="Tambah">                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            @include('Masterdata.brand.modaladdbrand')
        </div>
            @include('Masterdata.type.modaladdtype')
                            
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- /.content -->
@endsection
