<?php
class Course {
    private $conn;
    private $table_name = "courses";

    public $id;
    public $course_name;
    public $course_code;
    public $sks;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function readAll() {
        $query = "SELECT id, course_name, course_code, sks FROM " . $this->table_name . " ORDER BY id ASC";
        return $this->conn->query($query);
    }

    public function readOne() {
        $query = "SELECT course_name, course_code, sks FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            $this->course_name = $row['course_name'];
            $this->course_code = $row['course_code'];
            $this->sks = $row['sks'];
            return true;
        }
        return false;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (course_name, course_code, sks) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $this->course_name = htmlspecialchars(strip_tags($this->course_name));
        $this->course_code = htmlspecialchars(strip_tags($this->course_code));
        $this->sks = htmlspecialchars(strip_tags($this->sks));
        $stmt->bind_param("ssi", $this->course_name, $this->course_code, $this->sks);
        return $stmt->execute();
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET course_name = ?, course_code = ?, sks = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $this->course_name = htmlspecialchars(strip_tags($this->course_name));
        $this->course_code = htmlspecialchars(strip_tags($this->course_code));
        $this->sks = htmlspecialchars(strip_tags($this->sks));
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bind_param("ssii", $this->course_name, $this->course_code, $this->sks, $this->id);
        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bind_param("i", $this->id);
        return $stmt->execute();
    }
}
?>