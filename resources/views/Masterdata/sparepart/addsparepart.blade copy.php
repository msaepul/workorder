<!DOCTYPE html>
<html>

<head>
    <title>Dynamic Multiple Input dengan Select2</title>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
</head>

<body>
    <h2>Dynamic Multiple Input dengan Select2</h2>

    <table id="items_table">
        <tr>
            <th>Nama Barang</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        <tr>
            <td>
                <select class="item-select" name="item[]">
                    <option value="Barang 1">Barang 1</option>
                    <option value="Barang 2">Barang 2</option>
                    <option value="Barang 3">Barang 3</option>
                </select>
            </td>
            <td><input type="number" name="qty[]" min="1"></td>
            <td><input type="number" name="harga[]" min="0"></td>
            <td><button onclick="deleteRow(this)">Hapus</button></td>
        </tr>
    </table>

    <button onclick="addRow()">Tambah Baris</button>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inisialisasi Select2 pada elemen dengan class "item-select"
            $('.item-select').select2();
        });

        function addRow() {
            // Mendapatkan jumlah baris saat ini di tabel
            var rowCount = document.getElementById("items_table").rows.length;

            // Membuat elemen-elemen input baru
            var newRow = document.getElementById("items_table").insertRow(rowCount);
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            var cell4 = newRow.insertCell(3);

            // Mengatur HTML untuk elemen input baru
            cell1.innerHTML =
                '<select class="item-select" name="item[]"><option value="Barang 1">Barang 1</option><option value="Barang 2">Barang 2</option><option value="Barang 3">Barang 3</option></select>';
            cell2.innerHTML = '<input type="number" name="qty[]" min="1">';
            cell3.innerHTML = '<input type="number" name="harga[]" min="0">';
            cell4.innerHTML = '<button onclick="deleteRow(this)">Hapus</button>';

            // Menginisialisasi Select2 pada elemen select yang baru dibuat
            $('.item-select').select2();
        }

        function deleteRow(row) {
            var i = row.parentNode.parentNode.rowIndex;
            document.getElementById("items_table").deleteRow(i);
        }
    </script>
</body>

</html>
