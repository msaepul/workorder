<div class="modal" id="myModaleditbrand{{ $b->id }}">
    <form action="{{ route('mastereditbrand', $b->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Assuming you use PUT/PATCH for updating -->

        <div class="modal-dialog modal-dialog-centered-top">
            <div class="modal-content">
                <!-- Header Modal -->
                <div class="modal-header">
                    <h5 class="modal-title">Edit Brand</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Konten Modal -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_brand">Nama Brand</label>
                        <input type="text" class="form-control" id="nama_brand" name="nama_brand"
                            value="{{ $b->name_brand }}" placeholder="Nama Sparepart">
                        <input type="hidden" name="cabang_id" value="{{ getUserCabang() }}">
                    </div>

                    <div class="form-group">
                        <label for="ket_brand">Keterangan:</label>
                        <textarea class="form-control" id="ket_brand" name="ket_brand">{{ $b->ket_brand }}</textarea>
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
