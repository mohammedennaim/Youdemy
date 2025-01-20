<?php
namespace App\Controllers\Courses;
use App\Models\CourseModel;
use App\Models\Enrollment;

class CourseController
{
    private $courseModel;
    public function __construct()
    {
        $this->courseModel = new CourseModel();
    }

    public function createCourse($postData) {
        $title = trim($postData['title']);
        $description = trim($postData['description']);
        $content = trim($postData['content']);
        $enseignant_id = (int) $postData['enseignant_id'];
        $categorie_id = (int) $postData['category_id']; 
        $selectedTags = isset($postData['tags']) ? $postData['tags'] : [];

        $courseId = $this->courseModel-> addCourse($title, $description, $content, $categorie_id, $enseignant_id);

        if ($courseId) {
            $this->courseModel->insertCourseTags($courseId, $selectedTags);
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
    public function updateCourse($courseId, $data) {
        try {
            $updated = $this->courseModel->updateCourse($courseId, [
                'title' => trim($data['title']),
                'description' => trim($data['description']),
                'content' => trim($data['content']),
                'category_id' => (int) $data['category_id']
            ]);

            if ($updated) {
                $selectedTags = isset($data['tags']) ? $data['tags'] : [];
                $this->courseModel->updateCourseTags($courseId, $selectedTags);
                return true;
            }

            return false;
        } catch (\Exception $e) {
            return 'error ' . $e->getMessage();
        }
    }
}
?>