<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Dosen - CRUD MVC</title>
    <link href="<?= BASE_URL ?>/bootstrap.min.css" rel="stylesheet">
    <style> .container { padding-top: 20px; } </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= BASE_URL ?>/index.php">Sistem CRUD MVC</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link active" href="<?= BASE_URL ?>/index.php?controller=lecturer">Dosen</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/index.php?controller=course">Mata Kuliah</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/index.php?controller=schedule">Jadwal</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container my-4">
    <h2>Edit Dosen</h2>
    <div class="col-lg-6 m-auto">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="post" action="<?= BASE_URL ?>/index.php?controller=lecturer&action=edit&id=<?= $this->lecturer->id ?>">
            <div class="card">
                <div class="card-header bg-warning">
                    <h4 class="text-white text-center">Form Edit Dosen</h4>
                </div><br>
                
                <input type="hidden" name="id" value="<?= $this->lecturer->id ?>" class="form-control"> <br>
                
                <label> NAMA: </label>
                <input type="text" name="name" value="<?= $this->lecturer->name ?>" class="form-control"> <br>
                
                <label> NIDN: </label>
                <input type="text" name="nidn" value="<?= $this->lecturer->nidn ?>" class="form-control"> <br>
                
                <label> PHONE: </label>
                <input type="text" name="phone" value="<?= $this->lecturer->phone ?>" class="form-control"> <br>
                
                <label> JOIN DATE: </label>
                <input type="date" name="join_date" value="<?= $this->lecturer->join_date ?>" class="form-control"> <br>

                <label> EMAIL: </label>
                <input type="email" name="email" value="<?= $this->lecturer->email ?>" class="form-control"> <br>
                
                <button class="btn btn-success" type="submit" name="submit">Simpan Perubahan</button><br>
                <a class="btn btn-info" href="<?= BASE_URL ?>/index.php?controller=lecturer">Batal</a><br>
            </div>
        </form>
    </div>
</div>
<script src="<?= BASE_URL ?>/bootstrap.bundle.min.js"></script>
</body>
</html>