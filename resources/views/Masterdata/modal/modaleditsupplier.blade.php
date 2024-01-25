<div class="modal" id="myModaleditsupplier{{ $s->id }}">
    <form action="{{ route('mastereditsupplier', $s->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Assuming you use PUT/PATCH for updating -->

        <div class="modal-dialog modal-dialog-centered-top">
            <div class="modal-content">
                <!-- Header Modal -->
                <div class="modal-header">
                    <h5 class="modal-title">Edit supplier</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Konten Modal -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_supplier">Nama supplier</label>
                        <input type="text" class="form-control" id="nama_supplier" name="nama_supplier"
                            value="{{ $s->nama_supplier }}" placeholder="Nama Sparepart">
                        <input type="hidden" name="cabang_id" value="{{ getUserCabang() }}">
                    </div>

                    <div class="form-group">
                        <label for="alamat">Keterangan:</label>
                        <textarea class="form-control" id="alamat" name="alamat">{{ $s->alamat }}</textarea>
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
