<?php
namespace App\Models;

use App\Config\Database;
use PDO;

class CourseModel {
    private $conn;

    public $id;
    public $title;
    public $description;
    public $content;
    public $teacher_id;
    public $category_id;

    public function __construct() {
        
      $this->conn= Database::connection();
    }

    public function addCourse() {
        $query = 'INSERT INTO Courses (title, description, content, category_id) 
                  VALUES (:title, :description, :content, :category_id)';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":teacher_id", $this->teacher_id);
        $stmt->bindParam(":category_id", $this->category_id);
        return $stmt->execute();

    }

    public function listCourses() {
        $query = 'SELECT c.*, u.name AS teacher_name, COUNT(e.student_id) AS student_count FROM courses as c
        JOIN users AS u ON c.teacher_id = u.id 
        LEFT JOIN enrollments e ON c.id = e.course_id 
        GROUP BY c.id;';
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCoursesWithTags() {
        $query = '
            select 
                courses.id AS id,
                courses.title AS title,
                courses.description AS description,
                GROUP_CONCAT(tags.name SEPARATOR ", ") as tags
            from 
                course_tag
            join 
                tags ON tags.id = course_tag.tag_id
            join 
                courses ON courses.id = course_tag.course_id
            group by 
                courses.id, courses.title;
        ';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function supprimerCourse($course_id) {
        $query = "DELETE FROM enrollments WHERE course_id = $course_id;
                  DELETE FROM courses WHERE id = $course_id;";
        $stmt = $this->conn->prepare($query);   
        // $stmt->bindParam('', $course_id);
        $stmt->execute();
        if($stmt->execute()){
            return true;
        }
        return false;

    }
}
?>
