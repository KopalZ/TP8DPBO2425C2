<?php
// Mendefinisikan kelas Model untuk entitas Dosen
class Lecturer {
    private $conn; // Variabel untuk menyimpan objek koneksi database
    private $table_name = "lecturers"; // Nama tabel

    public $id;
    public $name;
    public $nidn;
    public $phone;
    public $join_date;
    public $email; // Atribut baru

    // Konstruktor: menerima koneksi DB dari Controller
    public function __construct($db) {
        $this->conn = $db;
    }

    // Fungsi untuk membaca semua data dosen
    public function readAll() {
        // Query SQL untuk memilih semua kolom dan mengurutkannya
        $query = "SELECT id, name, nidn, phone, join_date, email FROM " . $this->table_name . " ORDER BY id ASC";
        // Eksekusi query dan kembalikan hasilnya (sebagai objek mysqli_result)
        return $this->conn->query($query);
    }

    // Fungsi untuk membaca satu data dosen berdasarkan ID
    public function readOne() {
        // Query dengan Prepared Statement (placeholder '?') untuk keamanan
        $query = "SELECT name, nidn, phone, join_date, email FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        // Binding parameter: 'i' menandakan integer (id)
        $stmt->bind_param("i", $this->id);
        // Eksekusi statement
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc(); // Ambil satu baris hasil
        
        // Cek jika data ditemukan
        if ($row) {
            // Isi properti objek dengan data dari database
            $this->name = $row['name'];
            $this->nidn = $row['nidn'];
            $this->phone = $row['phone'];
            $this->join_date = $row['join_date'];
            $this->email = $row['email'];
            return true;
        }
        return false;
    }

    // Fungsi untuk membuat data dosen baru
    public function create() {
        // Query INSERT dengan Prepared Statement
        $query = "INSERT INTO " . $this->table_name . " (name, nidn, phone, join_date, email) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        
        // Sanitasi data dari XSS sebelum binding
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->nidn = htmlspecialchars(strip_tags($this->nidn));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->join_date = htmlspecialchars(strip_tags($this->join_date));
        $this->email = htmlspecialchars(strip_tags($this->email));
        
        // Binding parameter: 'sssss' menandakan semua string
        $stmt->bind_param("sssss", $this->name, $this->nidn, $this->phone, $this->join_date, $this->email);
        
        // Eksekusi dan kembalikan status sukses/gagal (untuk menangani NIDN/Email duplikat)
        return $stmt->execute();
    }

    // Fungsi untuk memperbarui data dosen
    public function update() {
        // Query UPDATE dengan Prepared Statement
        $query = "UPDATE " . $this->table_name . " SET name = ?, nidn = ?, phone = ?, join_date = ?, email = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        
        // Sanitasi data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->nidn = htmlspecialchars(strip_tags($this->nidn));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->join_date = htmlspecialchars(strip_tags($this->join_date));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        // Binding parameter: 'sssssi' (string, string, string, string, string, integer)
        $stmt->bind_param("sssssi", $this->name, $this->nidn, $this->phone, $this->join_date, $this->email, $this->id);
        
        // Eksekusi dan kembalikan status
        return $stmt->execute();
    }

    // Fungsi untuk menghapus data dosen
    public function delete() {
        // Query DELETE dengan Prepared Statement
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        
        // Sanitasi ID
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        // Binding parameter: 'i' (integer)
        $stmt->bind_param("i", $this->id);
        
        return $stmt->execute();
    }
}
?>