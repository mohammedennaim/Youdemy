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
        try {
            $sql = "INSERT INTO courses (title, description, content, teacher_id, category_id ) 
            VALUES (:title, :description, :content, :teacher_id, :category_id)";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':content', $content, PDO::PARAM_STR);
            $stmt->bindParam(':teacher_id', $teacher_id, PDO::PARAM_INT);
            $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);

            $stmt->execute();

            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de l'insertion du cours : " . $e->getMessage());
        }
    }

    public function addCourseTags($courseId, $tagIds)
    {
        try {
            $sql = "INSERT INTO course_tag (course_id, tag_id) VALUES (:course_id, :tag_id)";
            $stmt = $this->conn->prepare($sql);

            foreach ($tagIds as $tagId) {
                $stmt->execute([
                    ':course_id' => $courseId,
                    ':tag_id' => $tagId,
                ]);
            }
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de l'insertion des tags : " . $e->getMessage());
        }
    }

    public function updateCourse($courseId, $title, $description, $content, $categorie_id)
    {
        try {
            $sql = "UPDATE courses 
                    SET title = :title, description = :description, content = :content, category_id = :categorie_id
                    WHERE id = :courseId";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':courseId', $courseId, PDO::PARAM_INT);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':content', $content, PDO::PARAM_STR);
            $stmt->bindParam(':categorie_id', $categorie_id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de la mise à jour du cours : " . $e->getMessage());
        }
    }
    public function updateCourseTags($courseId, $tagIds)
    {
        try {
            $sql = "DELETE FROM course_tag WHERE course_id = :course_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':course_id' => $courseId]);

            $sql = "INSERT INTO course_tag (course_id, tag_id) VALUES (:course_id, :tag_id)";
            $stmt = $this->conn->prepare($sql);

            $tagIdsArray = is_string($tagIds) ? explode(',', $tagIds) : (array) $tagIds;

            foreach ($tagIdsArray as $tagId) {
                $stmt->execute([
                    ':course_id' => $courseId,
                    ':tag_id' => $tagId,
                ]);
            }
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de la mise à jour des tags : " . $e->getMessage());
        }
    }

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
        $query = 'SELECT courses.*, 
        GROUP_CONCAT(tags.name SEPARATOR ", ") as tags FROM course_tag 
        JOIN tags ON tags.id = course_tag.tag_id 
        JOIN courses ON courses.id = course_tag.course_id WHERE courses.id = :id 
        GROUP BY courses.id, courses.title;';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCourseByName($name)
    {
        $query = 'SELECT courses.*, 
              GROUP_CONCAT(tags.name SEPARATOR ", ") as tags 
              FROM courses 
              LEFT JOIN course_tag ON courses.id = course_tag.course_id 
              LEFT JOIN tags ON tags.id = course_tag.tag_id 
              WHERE courses.title LIKE "%:name%"
              GROUP BY courses.id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCoursesByTag($tagName)
{
    $query = 'SELECT courses.*, 
              GROUP_CONCAT(tags.name SEPARATOR ", ") as tags 
              FROM courses 
              LEFT JOIN course_tag ON courses.id = course_tag.course_id 
              LEFT JOIN tags ON tags.id = course_tag.tag_id 
              WHERE tags.name LIKE :tagName 
              GROUP BY courses.id';
    $stmt = $this->conn->prepare($query);
    $tagName = "%$tagName%"; 
    $stmt->bindParam(":tagName", $tagName);
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

    public function getAllTags()
    {
        $sql = "SELECT * FROM tags";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCourseTags($courseId)
    {
        $sql = "SELECT tag_id FROM course_tag WHERE course_id = :course_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':course_id', $courseId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    // public function getById($courseId) {
    //     try {
    //         $sql = "SELECT 
    //                 c.id AS course_id, *
    //                 GROUP_CONCAT(t.id SEPARATOR ',') AS tag_ids,
    //                 GROUP_CONCAT(t.titre SEPARATOR ',') AS tag_titles
    //             FROM 
    //                 courses c
    //             LEFT JOIN 
    //                 categories ON c.categorie_id = categories.id
    //             LEFT JOIN 
    //                 course_tag ON c.id = course_tag.course_id
    //             LEFT JOIN 
    //                 tags t ON course_tag.tag_id = t.id
    //             WHERE 
    //                 c.id = :course_id
    //             GROUP BY 
    //                 c.id;
    //         ";
    //         $stmt = $this->conn->prepare($sql);

    //         $stmt->execute([':course_id' => $courseId]);

    //         return $stmt->fetch(PDO::FETCH_ASSOC);
    //     } catch (PDOException $e) {
    //         throw new PDOException("Erreur lors de la récupération du cours : " . $e->getMessage());
    //     }
    // }

    public function inscrire($course_id, $etudiant_id)
    {
        try {
            $checkSql = "SELECT COUNT(*) FROM enrollments WHERE course_id = :course_id AND etudiant_id = :etudiant_id";
            $checkStmt = $this->conn->prepare($checkSql);
            $checkStmt->execute([':course_id' => $course_id, ':etudiant_id' => $etudiant_id]);

            if ($checkStmt->fetchColumn() > 0) {
                return "Vous êtes déjà inscrit à ce cours";
            }

            $sql = "INSERT INTO enrollments (course_id, etudiant_id) VALUES (:course_id, :etudiant_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':course_id' => $course_id, ':etudiant_id' => $etudiant_id]);
            return true;
        } catch (PDOException $e) {
            throw new PDOException("Erreur lors de l'inscription au cours : " . $e->getMessage());
        }
    }
}
?>