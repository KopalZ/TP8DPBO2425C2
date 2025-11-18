<?php
// Sertakan file koneksi DB
include_once 'config/connection.php';
// Sertakan file Model Dosen
include_once 'models/Lecturer.php';

// Mendefinisikan kelas Controller Dosen
class LecturerController {
    private $db; // Objek koneksi DB
    public $lecturer; // Objek Model Dosen

    // Konstruktor: inisialisasi Model
    public function __construct($db) {
        $this->db = $db;
        $this->lecturer = new Lecturer($this->db);
    }

    // Action 'index': Menampilkan daftar dosen
    public function index() {
        // Memanggil Model untuk mengambil semua data
        $result = $this->lecturer->readAll();
        // Memuat View untuk menampilkan daftar
        include 'views/lecturer_index.php';
    }

    // Action 'create': Menangani GET (tampilkan form) dan POST (simpan data)
    public function create() {
        $error = null; // Inisialisasi variabel error
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ambil data dari form POST dan set ke objek Model
            $this->lecturer->name = $_POST['name'];
            $this->lecturer->nidn = $_POST['nidn'];
            $this->lecturer->phone = $_POST['phone'];
            $this->lecturer->join_date = $_POST['join_date'];
            $this->lecturer->email = $_POST['email'];

            // Panggil metode create dari Model
            if ($this->lecturer->create()) {
                // Jika sukses, redirect ke halaman index
                header('Location: ' . BASE_URL . '/index.php?controller=lecturer');
                exit;
            } else {
                // Jika gagal (misal NIDN/Email duplikat), set pesan error
                $error = "Gagal menambah data. Pastikan NIDN dan Email unik.";
                // Tetap di halaman create, error akan ditampilkan di View
            }
        }
        // Muat View (baik untuk GET pertama kali atau POST yang gagal)
        include 'views/lecturer_create.php';
    }

    // Action 'edit': Menangani GET (tampilkan form terisi) dan POST (update data)
    public function edit() {
        $this->lecturer->id = isset($_GET['id']) ? $_GET['id'] : die(); // Ambil ID dari GET
        $error = null;
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ambil data dari form POST (data baru)
            $this->lecturer->name = $_POST['name'];
            $this->lecturer->nidn = $_POST['nidn'];
            $this->lecturer->phone = $_POST['phone'];
            $this->lecturer->join_date = $_POST['join_date'];
            $this->lecturer->email = $_POST['email'];
            $this->lecturer->id = $_POST['id']; // ID untuk klausa WHERE

            if ($this->lecturer->update()) {
                // Jika sukses, redirect ke halaman index
                header('Location: ' . BASE_URL . '/index.php?controller=lecturer');
                exit;
            } else {
                // Jika gagal, set pesan error
                $error = "Gagal memperbarui data. Pastikan NIDN dan Email unik.";
            }
        }
        
        // Membaca data lama dari database untuk diisi di form (diperlukan untuk GET atau POST gagal)
        if (!$this->lecturer->readOne()) {
            // Jika ID tidak ditemukan di DB, redirect
            header('Location: ' . BASE_URL . '/index.php?controller=lecturer');
            exit;
        }
        // Muat View edit
        include 'views/lecturer_edit.php';
    }

    // Action 'delete': Memproses penghapusan data
    public function delete() {
        $this->lecturer->id = isset($_GET['id']) ? $_GET['id'] : die(); // Ambil ID dari GET
        $this->lecturer->delete(); // Panggil Model untuk menghapus
        // Redirect kembali ke halaman index
        header('Location: ' . BASE_URL . '/index.php?controller=lecturer');
        exit;
    }
}
?>