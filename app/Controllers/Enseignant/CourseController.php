<?php
namespace App\Controllers\Courses;
use App\Models\CourseModel;
use App\Models\Enrollment;
use App\Models\TagModel;
use PDOException;
class CourseController
{
    private $courseModel;
    private $tagModel;
    public function __construct()
    {
        $this->courseModel = new CourseModel();
        $this->tagModel = new TagModel();
    }

    public function createCourse($postData) {
        $title = trim($postData['title']);
        $description = trim($postData['description']);
        $content = trim($postData['content']);
        $enseignant_id = (int) $postData['enseignant_id'];
        $categorie_id = (int) $postData['category_id']; 
        $selectedTags = isset($postData['tags']) ? $postData['tags'] : [];

        $course = $this->courseModel-> addCourse($title, $description, $content, $enseignant_id, $categorie_id);

        if ($course) {
            $this->courseModel->addCourseTags($courseId, $selectedTags);
        }

        return $course;
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

    public function suppressionCourse($id)
    {
        try {
            $supprimerCourse = $this->courseModel->supprimerCourse($id);
            return $supprimerCourse;
        } catch (\Exception $e) {
            return 'error ' . $e->getMessage();
        }
    }
    public function deleteCourse($id)
    {
        try {
            $result = $this->courseModel->delete($id);
            return $result;
            
        } catch (\Exception $e) {
            return 'error ' . $e->getMessage();
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

    public function updateCourse($courseId, $title,  $description, $content, $categorie_id, $tags_ids)
    {
        // var_dump($content,$description);
        // exit();
        try {
            $this->courseModel->updateCourseTags($courseId, $tags_ids);
            return $this->courseModel->updateCourse($courseId, $title, $description, $content, $categorie_id);
           // return true;
        } catch (\Exception $e) {
            return 'Erreur : ' . $e->getMessage(); 
        }
    }
}
?>