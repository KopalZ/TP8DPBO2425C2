<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Jadwal - CRUD MVC</title>
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
    <h2>Edit Jadwal</h2>
    <div class="col-lg-6 m-auto">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="post" action="<?= BASE_URL ?>/index.php?controller=schedule&action=edit&id=<?= $this->schedule->id ?>">
            <div class="card">
                <div class="card-header bg-warning">
                    <h4 class="text-white text-center">Form Edit Jadwal</h4>
                </div><br>
                
                <input type="hidden" name="id" value="<?= $this->schedule->id ?>" class="form-control"> <br>
                
                <label> DOSEN: </label>
                <select name="lecturer_id" class="form-control" required>
                    <option value="">-- Pilih Dosen --</option>
                    <?php 
                    // Pastikan pointer result disetel ulang jika digunakan sebelumnya
                    $lecturers->data_seek(0);
                    while($row = $lecturers->fetch_assoc()): ?>
                        <option value="<?= $row['id'] ?>" <?= ($this->schedule->lecturer_id == $row['id']) ? 'selected' : '' ?>>
                            <?= $row['name'] ?> (<?= $row['nidn'] ?>)
                        </option>
                    <?php endwhile; ?>
                </select> <br>

                <label> MATA KULIAH: </label>
                <select name="course_id" class="form-control" required>
                    <option value="">-- Pilih Mata Kuliah --</option>
                    <?php 
                    $courses->data_seek(0);
                    while($row = $courses->fetch_assoc()): ?>
                        <option value="<?= $row['id'] ?>" <?= ($this->schedule->course_id == $row['id']) ? 'selected' : '' ?>>
                            <?= $row['course_name'] ?> (<?= $row['course_code'] ?>)
                        </option>
                    <?php endwhile; ?>
                </select> <br>
                
                <label> HARI: </label>
                <select name="day" class="form-control" required>
                    <?php $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']; ?>
                    <option value="">-- Pilih Hari --</option>
                    <?php foreach ($days as $d): ?>
                        <option value="<?= $d ?>" <?= ($this->schedule->day == $d) ? 'selected' : '' ?>>
                            <?= $d ?>
                        </option>
                    <?php endforeach; ?>
                </select> <br>

                <label> WAKTU MULAI: </label>
                <input type="time" name="time_start" class="form-control" required value="<?= $this->schedule->time_start ?? '' ?>"> <br>

                <label> WAKTU SELESAI: </label>
                <input type="time" name="time_end" class="form-control" required value="<?= $this->schedule->time_end ?? '' ?>"> <br>

                <label> RUANGAN: </label>
                <input type="text" name="room" class="form-control" value="<?= $this->schedule->room ?? '' ?>"> <br>
                
                <button class="btn btn-success" type="submit" name="submit">Simpan Perubahan</button><br>
                <a class="btn btn-info" href="<?= BASE_URL ?>/index.php?controller=schedule">Batal</a><br>
            </div>
        </form>
    </div>
</div>
<script src="<?= BASE_URL ?>/bootstrap.bundle.min.js"></script>
</body>
</html>