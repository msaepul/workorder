<div class="modal" id="myModaldepartemen">
    <form action="{{ route('departemen_proses') }}" method="POST">
        @csrf
        <div class="modal-dialog modal-dialog-centered-top">
            <div class="modal-content">
                <!-- Header Modal -->
                <div class="modal-header">
                    <h5 class="modal-title">Add departemen</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Konten Modal -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama departemen :</label>
                        <input type="text" class="form-control" id="dept" name="dept"
                            value="{{ old('dept') }}">
                    </div>

                    <div class="form-group">
                        <label for="description">Keterangan:</label>
                        <textarea class="form-control" id="description" name="ket" value="{{ old('departemen') }}"></textarea>
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
