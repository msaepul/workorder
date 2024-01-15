<div class="modal" id="myModaljenis">
    <form action="{{ route('jenis_proses') }}" method="POST">
        @csrf
        <div class="modal-dialog modal-dialog-centered-top">
            <div class="modal-content">
                <!-- Header Modal -->
                <div class="modal-header">
                    <h5 class="modal-title">Add Jenis Perangkat</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Konten Modal -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama Jenis Perangkat:</label>
                        <input type="text" class="form-control" id="jenis_perangkat" name="jenis_perangkat"
                            value="{{ old('jenis_perangkat') }}">
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
