<div class="modal" id="myModaledittype{{ $t->id }}">
    <form action="{{ route('masteredittype', $t->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Assuming you use PUT/PATCH for updating -->

        <div class="modal-dialog modal-dialog-centered-top">
            <div class="modal-content">
                <!-- Header Modal -->
                <div class="modal-header">
                    <h5 class="modal-title">Edit type</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Konten Modal -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Type perangkat:</label>
                        <select class="form-control select2" id="id_jenis" name="id_jenis" style="width: 100%;">
                            <option value="">Pilih Jenis</option>
                            @foreach ($jeniss as $jenis)
                                <option value="{{ $jenis->id }}" @if ($jenis->id == $t->id_jenis) selected @endif>
                                    {{ $jenis->jenis_perangkat }}
                                </option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="nama_type">Nama type</label>
                        <input type="text" class="form-control" id="nama_type" name="nama_type"
                            value="{{ $t->name_type }}" placeholder="Nama Sparepart">
                    </div>

                    <div class="form-group">
                        <label for="ket_type">Keterangan:</label>
                        <textarea class="form-control" id="ket_type" name="ket_type">{{ $t->ket_type }}</textarea>
                    </div>
                </div>

                <!-- Input hidden -->
                <input type="hidden" class="form-control" id="id_cabang" name="id_cabang"
                    value="{{ getUserCabang() }}">

                <!-- Footer Modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>
