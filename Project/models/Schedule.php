<?php
class Schedule {
    private $conn;
    private $table_name = "schedule";

    public $id;
    public $lecturer_id;
    public $course_id;
    public $day;
    public $time_start;
    public $time_end;
    public $room;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Membaca semua jadwal dengan nama Dosen dan Mata Kuliah
    public function readAll() {
        $query = "SELECT 
                    s.id, 
                    l.name AS lecturer_name, 
                    c.course_name, 
                    s.day, 
                    s.time_start, 
                    s.time_end, 
                    s.room
                  FROM " . $this->table_name . " s
                  JOIN lecturers l ON s.lecturer_id = l.id
                  JOIN courses c ON s.course_id = c.id
                  ORDER BY s.day, s.time_start ASC";
        return $this->conn->query($query);
    }

    // Membaca satu jadwal
    public function readOne() {
        $query = "SELECT lecturer_id, course_id, day, time_start, time_end, room FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row) {
            $this->lecturer_id = $row['lecturer_id'];
            $this->course_id = $row['course_id'];
            $this->day = $row['day'];
            $this->time_start = $row['time_start'];
            $this->time_end = $row['time_end'];
            $this->room = $row['room'];
            return true;
        }
        return false;
    }

    // Membuat jadwal baru
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (lecturer_id, course_id, day, time_start, time_end, room) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        
        $this->day = htmlspecialchars(strip_tags($this->day));
        $this->time_start = htmlspecialchars(strip_tags($this->time_start));
        $this->time_end = htmlspecialchars(strip_tags($this->time_end));
        $this->room = htmlspecialchars(strip_tags($this->room));
        
        $stmt->bind_param("iissis", $this->lecturer_id, $this->course_id, $this->day, $this->time_start, $this->time_end, $this->room);
        return $stmt->execute();
    }

    // Memperbarui jadwal
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET lecturer_id = ?, course_id = ?, day = ?, time_start = ?, time_end = ?, room = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        
        $this->day = htmlspecialchars(strip_tags($this->day));
        $this->time_start = htmlspecialchars(strip_tags($this->time_start));
        $this->time_end = htmlspecialchars(strip_tags($this->time_end));
        $this->room = htmlspecialchars(strip_tags($this->room));
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        $stmt->bind_param("iissisi", $this->lecturer_id, $this->course_id, $this->day, $this->time_start, $this->time_end, $this->room, $this->id);
        return $stmt->execute();
    }

    // Menghapus jadwal
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bind_param("i", $this->id);
        return $stmt->execute();
    }
}
?>