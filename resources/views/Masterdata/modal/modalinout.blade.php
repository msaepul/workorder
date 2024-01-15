<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <nav class="w-100">
                    <div class="nav nav-tabs justify-content-start" id="product-tab" role="tablist" disabled>
                        <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc"
                            role="tab" aria-controls="product-desc" aria-selected="true">Tx Penambahan Sparepart</a>
                        <a class="nav-item nav-link justify-content-end" id="product-comments-tab" data-toggle="tab"
                            href="#product-comments" role="tab" aria-controls="product-comments"
                            aria-selected="false">Tx Pengurangan
                            Sparepart</a>
                    </div>

                </nav>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="tab-content p-3" id="nav-tabContent">
                <div class="tab-pane fade show active" id="product-desc" role="tabpanel"
                    aria-labelledby="product-desc-tab">
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="no_po">No PO</label>
                                        <input type="text" class="form-control" id="no_po" name="no_po"
                                            value="{{ old('no_po') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="supplier">Supplier</label>
                                        <input type="text" class="form-control" id="supplier" name="supplier"
                                            value="{{ old('supplier') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" id="form-group-container">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="nama_barang">Nama Barang</label>
                                        <input type="text" class="form-control" name="nama_barang"
                                            value="{{ old('nama_barang') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="qty">Qty</label>
                                        <input type="text" class="form-control" name="qty"
                                            value="{{ old('qty') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="harga_terbaru">Harga Terbaru:</label>
                                        <input type="text" class="form-control" name="harga_terbaru"
                                            value="{{ old('harga_terbaru') }}">
                                    </div>
                                    <div class="col-md-3 d-flex flex-column">
                                        <div class="mt-auto">
                                            <button class="btn btn-primary tambah-item-btn">Tambah Item</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                var addButton = document.querySelector('.tambah-item-btn');
                                var formGroupContainer = document.getElementById('form-group-container');

                                addButton.addEventListener('click', function() {
                                    var row = document.createElement('div');
                                    row.className = 'row';

                                    var col = document.createElement('div');
                                    col.className = 'col-md-4';
                                    var label = document.createElement('label');
                                    label.textContent = 'Nama Barang';
                                    var input = document.createElement('input');
                                    input.type = 'text';
                                    input.className = 'form-control';
                                    input.name = 'nama_barang';
                                    col.appendChild(label);
                                    col.appendChild(input);
                                    row.appendChild(col);

                                    col = document.createElement('div');
                                    col.className = 'col-md-2';
                                    label = document.createElement('label');
                                    label.textContent = 'Qty';
                                    input = document.createElement('input');
                                    input.type = 'text';
                                    input.className = 'form-control';
                                    input.name = 'qty';
                                    col.appendChild(label);
                                    col.appendChild(input);
                                    row.appendChild(col);

                                    col = document.createElement('div');
                                    col.className = 'col-md-3';
                                    label = document.createElement('label');
                                    label.textContent = 'Harga Terbaru:';
                                    input = document.createElement('input');
                                    input.type = 'text';
                                    input.className = 'form-control';
                                    input.name = 'harga_terbaru';
                                    col.appendChild(label);
                                    col.appendChild(input);
                                    row.appendChild(col);

                                    var buttonCol = document.createElement('div');
                                    buttonCol.className = 'col-md-3 d-flex flex-column';

                                    var deleteButtonContainer = document.createElement('div');
                                    deleteButtonContainer.className = 'mt-auto';

                                    var deleteButton = document.createElement('button');
                                    deleteButton.className = 'btn btn-danger hapus-item-btn';
                                    deleteButton.textContent = 'Hapus';
                                    deleteButton.addEventListener('click', function() {
                                        formGroupContainer.removeChild(row);
                                    });

                                    deleteButtonContainer.appendChild(deleteButton);
                                    buttonCol.appendChild(deleteButtonContainer);
                                    row.appendChild(buttonCol);

                                    formGroupContainer.appendChild(row);
                                });
                            </script>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary">Simpan</button>
                    </div>
                </div>

                <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab">

                    <div class="modal-body">
                        modal remove stock
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary">Simpan</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
