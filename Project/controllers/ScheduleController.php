<?php
include_once 'config/connection.php';
include_once 'models/Schedule.php';
include_once 'models/Lecturer.php';
include_once 'models/Course.php';

class ScheduleController {
    private $db;
    public $schedule;
    private $lecturer;
    private $course;

    public function __construct($db) {
        $this->db = $db;
        $this->schedule = new Schedule($this->db);
        $this->lecturer = new Lecturer($this->db);
        $this->course = new Course($this->db);
    }

    public function index() {
        $result = $this->schedule->readAll();
        include 'views/schedule_index.php';
    }

    public function create() {
        $lecturers = $this->lecturer->readAll();
        $courses = $this->course->readAll();
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->schedule->lecturer_id = $_POST['lecturer_id'];
            $this->schedule->course_id = $_POST['course_id'];
            $this->schedule->day = $_POST['day'];
            $this->schedule->time_start = $_POST['time_start'];
            $this->schedule->time_end = $_POST['time_end'];
            $this->schedule->room = $_POST['room'];

            if ($this->schedule->create()) {
                header('Location: ' . BASE_URL . '/index.php?controller=schedule');
                exit;
            } else {
                $error = "Gagal menambah jadwal.";
            }
        }
        include 'views/schedule_create.php';
    }

    public function edit() {
        $this->schedule->id = isset($_GET['id']) ? $_GET['id'] : die();
        $lecturers = $this->lecturer->readAll();
        $courses = $this->course->readAll();
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->schedule->lecturer_id = $_POST['lecturer_id'];
            $this->schedule->course_id = $_POST['course_id'];
            $this->schedule->day = $_POST['day'];
            $this->schedule->time_start = $_POST['time_start'];
            $this->schedule->time_end = $_POST['time_end'];
            $this->schedule->room = $_POST['room'];
            $this->schedule->id = $_POST['id'];

            if ($this->schedule->update()) {
                header('Location: ' . BASE_URL . '/index.php?controller=schedule');
                exit;
            } else {
                $error = "Gagal memperbarui jadwal.";
            }
        }
        
        if (!$this->schedule->readOne()) {
            header('Location: ' . BASE_URL . '/index.php?controller=schedule');
            exit;
        }
        include 'views/schedule_edit.php';
    }

    public function delete() {
        $this->schedule->id = isset($_GET['id']) ? $_GET['id'] : die();
        $this->schedule->delete();
        header('Location: ' . BASE_URL . '/index.php?controller=schedule');
        exit;
    }
}
?>