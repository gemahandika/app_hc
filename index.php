<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Demo DataTables Fixed Columns</title>

    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.3.0/css/fixedColumns.dataTables.min.css">

    <style>
        body {
            font-family: sans-serif;
            padding: 2rem;
        }

        table.dataTable td,
        table.dataTable th {
            white-space: nowrap;
        }

        th {
            background-color: #f8f8f8;
        }
    </style>
</head>

<body>

    <h2>🧊 Demo Fixed Columns: Kolom “Action” Freeze</h2>

    <table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th style="min-width: 160px;">Action</th>
                <th>Nama</th>
                <th>Posisi</th>
                <th>Branch</th>
                <th>Kategori</th>
                <th>Usia</th>
                <th>Tanggal Masuk</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 1; $i <= 20; $i++): ?>
                <tr>
                    <td>
                        <button class="btn btn-danger btn-sm">Resign</button>
                        <button class="btn btn-success btn-sm">Edit</button>
                    </td>
                    <td>Karyawan <?= $i ?></td>
                    <td>Kurir</td>
                    <td>KISARAN</td>
                    <td>MITRA</td>
                    <td><?= rand(21, 45) ?> TAHUN</td>
                    <td>2021-<?= rand(1, 12) ?>-<?= rand(1, 28) ?></td>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>

    <!-- JS Library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                scrollX: true,
                responsive: false,
                deferRender: true,
                fixedColumns: {
                    leftColumns: 1
                }
            });
        });
    </script>
</body>

</html>