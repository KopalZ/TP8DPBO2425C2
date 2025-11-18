<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Mata Kuliah - CRUD MVC</title>
    <link href="<?= BASE_URL ?>/bootstrap.min.css" rel="stylesheet">
    <style> .container { padding-top: 20px; } </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= BASE_URL ?>/index.php">Sistem CRUD MVC</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>/index.php?controller=lecturer">Dosen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?= BASE_URL ?>/index.php?controller=course">Mata Kuliah</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/index.php?controller=schedule">Jadwal</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container my-4">
    <h2>Tambah Mata Kuliah</h2>
    <div class="col-lg-6 m-auto">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="post" action="<?= BASE_URL ?>/index.php?controller=course&action=create">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-white text-center">Form Tambah Mata Kuliah</h4>
                </div><br>
                <label> NAMA MATA KULIAH: </label>
                <input type="text" name="course_name" class="form-control" required value="<?= $this->course->course_name ?? '' ?>"> <br>
                <label> KODE MATA KULIAH: </label>
                <input type="text" name="course_code" class="form-control" required value="<?= $this->course->course_code ?? '' ?>"> <br>
                <label> SKS: </label>
                <input type="number" name="sks" class="form-control" required value="<?= $this->course->sks ?? '' ?>"> <br>
                
                <button class="btn btn-success" type="submit" name="submit">Simpan</button><br>
                <a class="btn btn-info" href="<?= BASE_URL ?>/index.php?controller=course">Batal</a><br>
            </div>
        </form>
    </div>
</div>
<script src="<?= BASE_URL ?>/bootstrap.bundle.min.js"></script>
</body>
</html>