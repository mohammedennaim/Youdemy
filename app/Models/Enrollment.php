<?php

namespace App\Models;

use App\Config\Database;
use PDO;
use PDOException;

class Enrollment {
    private $id;
    private $student_id;
    private $course_id;

    private $conn;
 
    public function __construct() {
        $this->conn = Database::connection();
    }

    public function enroll($student_id,$course_id) {
        try {
            $sql = "INSERT INTO enrollments (student_id, course_id) VALUES (:student_id, :course_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':student_id', $student_id);
            $stmt->bindParam(':course_id', $course_id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function getEnrolledCourses($studentId) {
        try {
            $sql = "SELECT c.title, c.description, c.teacher_name FROM enrollments e JOIN courses c ON e.course_id = c.id WHERE e.student_id = :student_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':student_id', $studentId);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

}
