<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jadwal Kuliah - CRUD MVC</title>
    <link href="<?= BASE_URL ?>/bootstrap.min.css" rel="stylesheet">
    <style> .container { padding-top: 20px; } </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= BASE_URL ?>/index.php">Sistem CRUD MVC</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/index.php?controller=lecturer">Dosen</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/index.php?controller=course">Mata Kuliah</a></li>
                <li class="nav-item"><a class="nav-link active" href="<?= BASE_URL ?>/index.php?controller=schedule">Jadwal</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container my-4">
    <h2>Daftar Jadwal Kuliah</h2>
    <div class="my-3">
        <a type="button" class="btn btn-primary" href="<?= BASE_URL ?>/index.php?controller=schedule&action=create">Tambah Jadwal</a>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>NO.</th>
                <th>DOSEN</th>
                <th>MATA KULIAH</th>
                <th>HARI</th>
                <th>WAKTU</th>
                <th>RUANGAN</th>
                <th>ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1; // Variabel Nomor Urut
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>{$no}</td>
                        <td>{$row['lecturer_name']}</td>
                        <td>{$row['course_name']}</td>
                        <td>{$row['day']}</td>
                        <td>{$row['time_start']} - {$row['time_end']}</td>
                        <td>{$row['room']}</td>
                        <td>
                            <a class='btn btn-success btn-sm' href='" . BASE_URL . "/index.php?controller=schedule&action=edit&id={$row['id']}'>Edit</a>
                            <a class='btn btn-danger btn-sm' href='" . BASE_URL . "/index.php?controller=schedule&action=delete&id={$row['id']}' onclick=\"return confirm('Yakin ingin menghapus data ini?');\">Hapus</a>
                        </td>
                    </tr>
                    ";
                    $no++; // Increment di luar echo
                }
            } else {
                echo "<tr><td colspan='7' class='text-center'>Tidak ada data jadwal.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<script src="<?= BASE_URL ?>/bootstrap.bundle.min.js"></script>
</body>
</html>