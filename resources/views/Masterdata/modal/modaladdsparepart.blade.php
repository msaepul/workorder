<div class="modal" id="myModalsparepart">
    <form action="{{ route('sparepart_proses') }}" method="POST">
        @csrf
        <div class="modal-dialog modal-dialog-centered-top">
            <div class="modal-content">
                <!-- Header Modal -->
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Sparepart</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Konten Modal -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Sparepart</label>
                        <input type="text" class="form-control" id="nama_sparepart" name="nama_sparepart"
                            value="{{ old('nama_sparepart') }}" placeholder="Nama Sparepart">
                    </div>


                    <div class="form-group">
                        <label for="description">Keterangan:</label>
                        <textarea class="form-control" id="description" name="ket_sparepart" value="{{ old('ket_sparepart') }}"></textarea>
                    </div>

                </div>

                <input type="hidden" class="form-control" id="id_cabang" name="id_cabang"
                    value="{{ old('id_cabang') }}">
    </form>

    <!-- Footer Modal -->
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</div>

</div>
