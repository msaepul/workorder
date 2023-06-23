<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{ route('supplier_proses') }}" method="POST">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!-- Konten Modal -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nama supplier :</label>
                            <input type="text" class="form-control" id="nama_supplier" name="nama_supplier"
                                value="{{ old('nama_supplier') }}">
                        </div>

                        <div class="form-group">
                            <label for="description">Alamat:</label>
                            <textarea class="form-control" id="description" name="alamat" value="{{ old('alamat') }}"></textarea>
                        </div>

                    </div>
                </div>
    </form>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</div>
</div>

</div>
