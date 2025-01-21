<?php
namespace App\Controllers\Courses;
use App\Models\CourseModel;
use App\Models\Enrollment;
use App\Models\TagModel;
// use PDOException;
class CourseController
{
    private $courseModel;
    private $tagModel;
    public function __construct()
    {
        $this->courseModel = new CourseModel();
        $this->tagModel = new TagModel();
    }

    public function createCourse($data) {
        $title = trim($data['title']);
        $description = trim($data['description']);
        $content = trim($data['content']);
        $enseignant_id = (int) $data['enseignant_id'];
        $categorie_id = (int) $data['category_id'];
        $selectedTags = isset($data['tags']) ? $data['tags'] : [];
    
        $courseId = $this->courseModel->addCourse($title, $description, $content, $enseignant_id, $categorie_id);
    
        if ($courseId && !empty($selectedTags)) {
            $this->courseModel->addCourseTags($courseId, $selectedTags);
        }
    
        return $courseId;
    }

    public function getAllCourses()
    {
        try {
            $courses = $this->courseModel->listCourses();
            return $courses;
        } catch (\Exception $e) {
            return 'error ' . $e->getMessage();
        }
    }

    public function getCourseById($id){
        try {
            $course = $this->courseModel->getCourseById($id);
            return $course;
        } catch (\Exception $e) {
            return 'error ' . $e->getMessage();
        }
    }
    public function listCoursesbyTags()
    {
        try {
            $courses = $this->courseModel->getCoursesWithTags();
            return $courses;
        } catch (\Exception $e) {
            return 'error ' . $e->getMessage();
        }

    }

    public function deleteCourse($id) {
        try {
            return $this->courseModel->delete($id);
        } catch (\Exception $e) {
            error_log("Erreur lors de la suppression du cours : " . $e->getMessage());
            return false;
        }
    }

    public function enrollCourse($courseId) {
        session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
            header('Location: course.php');
            exit();
        }
        $student_id = $_SESSION['user']['id'];
        $course_id = $courseId;
        $enrollmentModel = new Enrollment();
        if ($enrollmentModel->enroll($student_id,$course_id)) {
            echo "Enrolled successfully!";
            header('Location: course.php');
            exit();
        } else {
            echo "Failed to enroll.";
            header('Location: login.php');
            exit();
        }
    }

    public function myCourses() {
        session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
            echo "Access denied!";
            return;
        }
        $enrollmentModel = new Enrollment();
        $courses = $enrollmentModel->getEnrolledCourses($_SESSION['user']['id']);
        if($courses) {
            header('Location: ./views/etudiant/courses.php');
            exit();
        }
    }

    public function updateCourse($courseId, $title, $description, $content, $categorie_id, $tags_ids) {
        // var_dump($content,$description);
        // exit();
        try {
            $this->courseModel->updateCourseTags($courseId, $tags_ids);
            return $this->courseModel->updateCourse($courseId, $title, $description, $content, $categorie_id);
        } catch (\Exception $e) {
            error_log("Erreur lors de la mise à jour du cours : " . $e->getMessage());
            return false;
        }
    }
}
?>