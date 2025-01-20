<?php
namespace App\Models;

use App\Config\Database;
use PDO;
use PDOException;

class CourseModel
{
    private $conn;

    public $id;
    public $title;
    public $description;
    public $content;
    public $teacher_id;
    public $category_id;

    public function __construct()
    {
        $this->conn = Database::connection();
    }

    public function addCourse($title, $description, $content, $teacher_id, $category_id)
    {
        $query = "INSERT INTO courses (title, description, content, teacher_id, category_id) VALUES (:title, :description, :content, :teacher_id, :category_id)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':teacher_id', $teacher_id);
        $stmt->bindParam(':category_id', $category_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function updateCourse($id, $title, $description, $content, $teacher_id, $category_id)
    {
        $query = "UPDATE courses SET title = :title, description = :description, content = :content, teacher_id = :teacher_id, category_id = :category_id WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':teacher_id', $teacher_id);
        $stmt->bindParam(':category_id', $category_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // public function delete($id) {
    //     $query = "DELETE FROM enrollments WHERE course_id = :id";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(':id', $id);
    //     $enrollresultat=$stmt->execute();

    //     if ($enrollresultat) {
    //             $query = "DELETE FROM course_tag WHERE course_id = :id";
    //             $stmt = $this->conn->prepare($query);
    //             $stmt->bindParam(':id', $id);
    //             $tagResultat=$stmt->execute();

    //         if ($tagResultat) {
    //             $query = "DELETE FROM courses WHERE id = :id";
    //             $stmt = $this->conn->prepare($query);
    //             $stmt->bindParam(':id', $id);
    //             $courseResultat=$stmt->execute() ;

    //             if ($courseResultat) {
    //                 return true;
    //             }
    //             return false;
    //         }
    //     }
    // }
    public function delete($id)
    {

        try {

            $query = "DELETE FROM enrollments WHERE course_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $query = "DELETE FROM course_tag WHERE course_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $query = "DELETE FROM courses WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return true;

        } catch (PDOException $e) {
            $this->conn->rollBack();
            error_log("Erreur lors de la suppression du cours: " . $e->getMessage());
            return false;
        }
    }

    public function listCourses()
    {
        $query = 'SELECT c.*, u.name AS teacher_name, COUNT(e.user_id) AS user_count FROM courses AS c
        JOIN users AS u ON c.teacher_id = u.id 
        LEFT JOIN enrollments e ON c.id = e.course_id 
        GROUP BY c.id;';
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCourseById($id)
    {
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

    public function getCoursesWithTags()
    {
        $query = '
            SELECT 
                courses.id AS id,
                courses.title AS title,
                courses.description AS description,
                GROUP_CONCAT(tags.name SEPARATOR ", ") as tags
            FROM 
                course_tag
            JOIN 
                tags ON tags.id = course_tag.tag_id
            JOIN 
                courses ON courses.id = course_tag.course_id
            GROUP BY 
                courses.id, courses.title;
        ';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // public function getTagsForCourse($courseId) {
    //     $query = "SELECT tag_id FROM course_tag WHERE course_id = :course_id";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(':course_id', $courseId, PDO::PARAM_INT);
    //     $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    // }
}
?>