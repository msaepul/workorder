<div class="modal" id="myModaleditdepartemen{{ $d->id }}">
    <form action="{{ route('mastereditdepartemen', $d->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Assuming you use PUT/PATCH for updating -->

        <div class="modal-dialog modal-dialog-centered-top">
            <div class="modal-content">
                <!-- Header Modal -->
                <div class="modal-header">
                    <h5 class="modal-title">Edit departemen</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Konten Modal -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_departemen">Nama departemen</label>
                        <input type="text" class="form-control" id="departemen" name="departemen"
                            value="{{ $d->dept }}" placeholder="Nama Sparepart">
                    </div>

                    <div class="form-group">
                        <label for="ket_departemen">Keterangan:</label>
                        <textarea class="form-control" id="ket" name="ket">{{ $d->ket }}</textarea>
                    </div>
                </div>
                <!-- Footer Modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>
