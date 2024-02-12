<div class="modal" id="myModalcabang">
    <form action="{{ route('cabang_proses') }}" method="POST">
        @csrf
        <div class="modal-dialog modal-dialog-centered-top">
            <div class="modal-content">
                <!-- Header Modal -->
                <div class="modal-header">
                    <h5 class="modal-title">Add cabang</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Konten Modal -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama cabang :</label>
                        <input type="text" class="form-control" id="cabang" name="cabang"
                            value="{{ old('cabang') }}">
                    </div>

                    <div class="form-group">
                        <label for="description">Keterangan:</label>
                        <textarea class="form-control" id="description" name="ket" value="{{ old('ket') }}"></textarea>
                    </div>

                </div>
    </form>

    <!-- Footer Modal -->
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</div>

</div>
