# Janji
Saya Naufal Zahid dengan NIM 2405787 mengerjakan TP 8 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin

# Sistem Manajemen Dosen dan Mata Kuliah — PHP MVC

Proyek ini merupakan implementasi website berbasis PHP Native dengan penerapan pola arsitektur Model-View-Controller (MVC) untuk mengelola data Dosen, Mata Kuliah, dan Jadwal.

Seluruh interaksi dengan database menggunakan Prepared Statement untuk menjamin keamanan dari serangan SQL Injection. Fitur utama yang diimplementasikan adalah CRUD (Create, Read, Update, Delete) untuk setiap entitas.

---

## 🔗 Informasi Repositori

| Kategori | Detail |
| :--- | :--- |
| **Nama Repo** | `TP8DPBO2425C2` |
| **Database** | `tp_mvc25` (3 tabel: Lecturer, Course, Schedule) |

---

## Tema Website: Sistem Informasi Dosen & Jadwal

Website ini digunakan untuk mencatat dan menampilkan data Dosen, Mata Kuliah, dan Jadwal mengajar, serta hubungan relasi antar data.

Contoh penggunaan:
- User dapat menambahkan data Dosen baru (termasuk NIDN dan email unik).
- User dapat menambahkan Mata Kuliah baru (termasuk kode mata kuliah unik).
- User dapat membuat Jadwal, menghubungkan Dosen tertentu dengan Mata Kuliah tertentu, hari, waktu, dan ruangan.

---

## 🗃️ Struktur Database

### 1️⃣ Tabel `lecturers`

| Kolom | Tipe | Keterangan |
| :--- | :--- | :--- |
| `id` | INT (PK, AUTO_INCREMENT) | ID unik untuk Dosen |
| `nama_asrama` | VARCHAR(100) | Nama Dosen |
| `nidn` | VARCHAR(20) (UNIQUE) | Nomor Induk Dosen Nasional |
| `phone` | VARCHAR(20) | Nomor Telepon |
| `join_date` | DATE | Tanggal Masuk |
| `email` | VARCHAR(100) (UNIQUE) | Email Dosen |

### 2️⃣ Tabel `peran`

| Kolom | Tipe | Keterangan |
| :--- | :--- | :--- |
| `id` | INT (PK, AUTO_INCREMENT) | ID unik untuk Mata Kuliah |
| `course_name` | VARCHAR(100) | Nama Mata Kuliah |
| `course_code` | VARCHAR(10) (UNIQUE) | Kode Mata Kuliah |
| `sks` | INT(2) | Jumlah SKS |

### 3️⃣ Tabel `anggota`

| Kolom | Tipe | Keterangan |
| :--- | :--- | :--- |
| `id` | INT (PK, AUTO_INCREMENT) | ID unik untuk Jadwal |
| `lecturer_id` | INT (FK → lecturers.id) | Dosen yang Mengajar (Relasi) |
| `course_id` | INT (FK → courses.id) | Mata Kuliah yang Diajarkan (Relasi) |
| `day` | VARCHAR(10) | Hari Mengajar |
| `time_start` | TIME | Waktu Mulai |
| `time_end` | TIME | Waktu Selesai |
| `room` | VARCHAR(20) | Ruangan |

---

## 🧩 Fitur Utama (CRUD per Entitas)

| Entitas | Fitur | Deskripsi |
| :--- | :--- | :--- |
| **Dosen** | Create, Read, Update, Delete | Kelola data dasar dosen, termasuk NIDN dan Email unik. |
| **Mata Kuliah** | Create, Read, Update, Delete | Kelola data mata kuliah (Nama, Kode, SKS). |
| **Jadwal** | Create, Read, Update, Delete | Kelola relasi Dosen & Mata Kuliah, termasuk Hari, Waktu, dan Ruangan. |

---

## 🏗️ Struktur Folder Proyek

```bash
 TP8/
  ├── config/
  │   └── connection.php          # Tempat setting koneksi DB
  │
  ├── controllers/
  │   ├── LecturerController.php  # Otak CRUD Dosen
  │   ├── CourseController.php    # Otak CRUD Mata Kuliah
  │   └── ScheduleController.php  # Otak CRUD Jadwal
  │
  ├── models/
  │   ├── Lecturer.php            # Kode SQL Dosen (CRUD)
  │   ├── Course.php              # Kode SQL Mata Kuliah (CRUD)
  │   └── Schedule.php            # Kode SQL Jadwal (CRUD + JOIN)
  │
  ├── views/                      
  │   ├── course_create.php
  │   ├── course_edit.php
  │   ├── course_index.php
  │   ├── lecturer_create.php
  │   ├── lecturer_edit.php
  │   ├── lecturer_index.php
  │   ├── schedule_create.php
  │   ├── schedule_edit.php
  │   └── schedule_index.php
  │
  ├── index.php                   
  ├── bootstrap.bundle.min.js    
  ├── bootstrap.min.css           
  └── jquery.min.js               
```

---

## Flow / Alur Program
### 1. index.php
- Berfungsi sebagai titik masuk tunggal.
- Menganalisis parameter `controller` dan `action` pada URL (`?controller=lecturer&action=create`).
- Menginisialisasi Controller yang sesuai dan memanggil metode (Action) yang diminta.
  
### 2. Controller
- Mengambil Input (dari URL/Form POST).
- Memanggil Model untuk memanipulasi data (misal: `create()`, `readAll()`)
- Memilih View yang akan ditampilkan, melewatkan data dari Model ke View.
  
### 3. Model
- Berinteraksi langsung dengan database.
- Masing-masing memiliki fungsi CRUD: `readAll()`, `create()`, `update()`, dan `delete()`.
- Menggunakan Prepared Statements (`mysqli->prepare`) untuk semua operasi yang melibatkan input pengguna.

### 4. View
- Berisi kode HTML dan PHP minimal.
- Bertanggung jawab hanya untuk menyajikan data yang diterima dari Controller.
- Data tabel ditampilkan dengan Nomor Urut Dinamis menggunakan loop counter PHP.

---

## 💻 Cara Menjalankan
1. Import file `.sql` Anda ke dalam database MySQL lokal bernama `tp_mvc25`.
2. Pastikan `config/connection.php` sudah sesuai dengan username dan password database lokal Anda.
3. Jalankan aplikasi di browser dengan membuka:
    ```bash
    [http://localhost/TP7/index.php]
    ```
4. Navigasi ke tiap halaman (Dosen, Mata Kuliah, Jadwal) melalui Navbar.

---

## 🎥 Dokumentasi

