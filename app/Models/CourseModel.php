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
    


    public function addCourse($title, $description, $content, $enseignant_id, $categorie_id) {
        $query = "INSERT INTO courses (title, description, content, enseignant_id, categorie_id) VALUES (:title, :description, :content, :enseignant_id, :categorie_id)";
        $stmt = $this->conn->prepare($query);

        $title = htmlspecialchars($title);
        $description = htmlspecialchars($description);
        $content = htmlspecialchars($content);        
        $enseignant_id = htmlspecialchars($enseignant_id);
        $categorie_id = htmlspecialchars($categorie_id);

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':enseignant_id', $enseignant_id);
        $stmt->bindParam(':categorie_id', $categorie_id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function updateCourse($id, $title, $description, $content, $enseignant_id, $categorie_id) {
        $query = "UPDATE courses SET title = :title, description = :description, content = :content , enseignant_id = :enseignant_id , categorie_id = :categorie_id WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $id = htmlspecialchars($id);
        $title = htmlspecialchars($title);
        $description = htmlspecialchars($description);
        $content = htmlspecialchars($content);        
        $enseignant_id = htmlspecialchars($enseignant_id);
        $categorie_id = htmlspecialchars($categorie_id);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':enseignant_id', $enseignant_id);
        $stmt->bindParam(':categorie_id', $categorie_id);


        if ($stmt->execute()) {
            return true;
        }
        return false;
    }


    public function delete($id) {
        $query = "DELETE FROM enrollments WHERE courseid = :id";
        $stmt = $this->conn->prepare($query);

        $id = htmlspecialchars(strip_tags($id));

        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function listCourses() {
        $query = 'SELECT c.*, u.name AS teacher_name, COUNT(e.user_id) AS user_count FROM courses as c
        JOIN users AS u ON c.teacher_id = u.id 
        LEFT JOIN enrollments e ON c.id = e.course_id 
        GROUP BY c.id;';
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function CourseById($id) { 
        $query = 'SELECT courses.id, courses.title AS title, courses.description AS description, 
        GROUP_CONCAT(tags.name SEPARATOR ", ") as tags FROM course_tag 
        JOIN tags ON tags.id = course_tag.tag_id 
        JOIN courses ON courses.id = course_tag.course_id WHERE courses.id = :id 
        GROUP BY courses.id, courses.title;'; 
        $stmt = $this->conn->prepare($query); 
        $stmt->bindParam(":id", $id, PDO::PARAM_INT); 
        $stmt->execute(); 
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
}
?>


 