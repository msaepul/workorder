<div class="modal" id="myModaleditsparepart{{ $part->id }}">
    <form action="{{ route('masteredit', $part->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Assuming you use PUT/PATCH for updating -->

        <div class="modal-dialog modal-dialog-centered-top">
            <div class="modal-content">
                <!-- Header Modal -->
                <div class="modal-header">
                    <h5 class="modal-title">Edit Sparepart</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Konten Modal -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_sparepart">Nama Sparepart</label>
                        <input type="text" class="form-control" id="nama_sparepart" name="nama_sparepart"
                            value="{{ $part->nama_sparepart }}" placeholder="Nama Sparepart">
                        <input type="hidden" name="cabang_id" value="{{ getUserCabang() }}">
                    </div>

                    <div class="form-group">
                        <label for="ket_sparepart">Keterangan:</label>
                        <textarea class="form-control" id="ket_sparepart" name="ket_sparepart">{{ $part->ket_sparepart }}</textarea>
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
