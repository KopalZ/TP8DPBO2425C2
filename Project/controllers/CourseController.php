<?php
include_once 'config/connection.php';
include_once 'models/Course.php';

class CourseController {
    private $db;
    public $course;

    public function __construct($db) {
        $this->db = $db;
        $this->course = new Course($this->db);
    }

    public function index() {
        $result = $this->course->readAll();
        include 'views/course_index.php';
    }

    public function create() {
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->course->course_name = $_POST['course_name'];
            $this->course->course_code = $_POST['course_code'];
            $this->course->sks = $_POST['sks'];

            if ($this->course->create()) {
                header('Location: ' . BASE_URL . '/index.php?controller=course');
                exit;
            } else {
                $error = "Gagal menambah data. Pastikan Kode Mata Kuliah unik.";
            }
        }
        include 'views/course_create.php';
    }

    public function edit() {
        $this->course->id = isset($_GET['id']) ? $_GET['id'] : die();
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->course->course_name = $_POST['course_name'];
            $this->course->course_code = $_POST['course_code'];
            $this->course->sks = $_POST['sks'];
            $this->course->id = $_POST['id'];

            if ($this->course->update()) {
                header('Location: ' . BASE_URL . '/index.php?controller=course');
                exit;
            } else {
                $error = "Gagal memperbarui data. Pastikan Kode Mata Kuliah unik.";
            }
        }
        
        if (!$this->course->readOne()) {
            header('Location: ' . BASE_URL . '/index.php?controller=course');
            exit;
        }
        include 'views/course_edit.php';
    }

    public function delete() {
        $this->course->id = isset($_GET['id']) ? $_GET['id'] : die();
        $this->course->delete();
        header('Location: ' . BASE_URL . '/index.php?controller=course');
        exit;
    }
}
?>