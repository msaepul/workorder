<div class="modal" id="myModalbrand">
    <form action="{{ route('brand_proses') }}" method="POST">
        @csrf
        <div class="modal-dialog modal-dialog-centered-top">
            <div class="modal-content">
                <!-- Header Modal -->
                <div class="modal-header">
                    <h5 class="modal-title">Add Brand / Merek</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Konten Modal -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nama brand / merk:</label>
                        <input type="text" class="form-control" id="nama_brand" name="nama_brand"
                            value="{{ old('nama_brand') }}">
                    </div>

                    <div class="form-group">
                        <label for="description">Keterangan:</label>
                        <textarea class="form-control" id="description" name="ket_brand" value="{{ old('ket_brand') }}"></textarea>
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
