<div class="modal" id="myModaltype">
  <form action="{{ route('type_proses') }}" method="POST">
      @csrf
<div class="modal-dialog modal-dialog-centered-top">
  <div class="modal-content">
    <!-- Header Modal -->
    <div class="modal-header">
      <h5 class="modal-title">Add Type Perangkat</h5>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>

    <!-- Konten Modal -->
    <div class="modal-body">
      <div class="form-group">
          <label for="name">Nama Type perangkat:</label>
          <input type="text" class="form-control" id="nama_brand" name="nama_type" value="{{ old('nama_type') }}">
        </div>
        
        <div class="form-group">
          <label for="description">Keterangan:</label>
          <textarea class="form-control" id="description" name="ket_type" value="{{ old('ket_type')}}"></textarea>
        </div>
        
    </div></form>

    <!-- Footer Modal -->
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </div>

</div>