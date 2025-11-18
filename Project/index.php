<?php
// Tentukan path dasar untuk includes (membantu resolve path relatif)
define('ROOT_PATH', __DIR__);

// Sertakan file koneksi database
include_once 'config/connection.php';

// Ambil parameter 'controller' dari URL (default: 'lecturer')
$controller_name = isset($_GET['controller']) ? $_GET['controller'] : 'lecturer';
// Ambil parameter 'action' dari URL (default: 'index' -> menampilkan daftar)
$action_name = isset($_GET['action']) ? $_GET['action'] : 'index';

// Tentukan Controller mana yang akan dimuat berdasarkan parameter URL
switch ($controller_name) {
    case 'lecturer':
        // Sertakan file Controller Dosen
        include_once 'controllers/LecturerController.php';
        // Buat instance Controller Dosen dan berikan koneksi DB
        $controller = new LecturerController($conn);
        break;
    case 'course':
        // Sertakan file Controller Mata Kuliah
        include_once 'controllers/CourseController.php';
        // Buat instance Controller Mata Kuliah
        $controller = new CourseController($conn);
        break;
    case 'schedule': // Controller baru untuk Jadwal
        // Sertakan file Controller Jadwal
        include_once 'controllers/ScheduleController.php';
        // Buat instance Controller Jadwal
        $controller = new ScheduleController($conn);
        break;
    default:
        // Default ke LecturerController jika nama controller tidak valid
        include_once 'controllers/LecturerController.php';
        $controller = new LecturerController($conn);
        break;
}

// Panggil metode (action) yang sesuai di dalam Controller
if (method_exists($controller, $action_name)) {
    // Eksekusi method, misalnya $controller->index();
    $controller->$action_name();
} else {
    // Tangani aksi/method yang tidak valid
    header("HTTP/1.0 404 Not Found");
    echo "404 Not Found - Action '{$action_name}' not found in '{$controller_name}' Controller.";
    exit;
}
?>