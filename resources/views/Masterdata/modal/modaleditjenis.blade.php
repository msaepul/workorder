<div class="modal" id="myModaleditjenis{{ $j->id }}">
    <form action="{{ route('mastereditjenis', $j->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Assuming you use PUT/PATCH for updating -->

        <div class="modal-dialog modal-dialog-centered-top">
            <div class="modal-content">
                <!-- Header Modal -->
                <div class="modal-header">
                    <h5 class="modal-title">Edit jenis</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Konten Modal -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jenis_perangkat">Nama jenis</label>
                        <input type="text" class="form-control" id="jenis_perangkat" name="jenis_perangkat"
                            value="{{ $j->jenis_perangkat }}" placeholder="Nama Jenis Perangkat">
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
