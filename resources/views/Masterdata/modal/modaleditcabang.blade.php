<div class="modal" id="myModaleditcabang{{ $c->id }}">
    <form action="{{ route('mastereditcabang', $c->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Assuming you use PUT/PATCH for updating -->

        <div class="modal-dialog modal-dialog-centered-top">
            <div class="modal-content">
                <!-- Header Modal -->
                <div class="modal-header">
                    <h5 class="modal-title">Edit Cabang</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Konten Modal -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_cabang">Nama Cabang</label>
                        <input type="text" class="form-control" id="cabang" name="cabang"
                            value="{{ $c->cabang }}" placeholder="Nama Sparepart">
                        <input type="hidden" name="cabang_id" value="{{ getUserCabang() }}">
                    </div>

                    <div class="form-group">
                        <label for="ket_cabang">Keterangan:</label>
                        <textarea class="form-control" id="ket" name="ket">{{ $c->ket }}</textarea>
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
