<?php
namespace App\Controllers\Courses;
use App\Models\CourseModel;

class CourseController {
    private $courseModel;
    public function __construct() {
        $this->courseModel = new CourseModel();
    }
    public function getAllCourses() {
        try{
            $courses = $this->courseModel->listCourses();
            return $courses;
        } catch (\Exception $e) {
            return 'error '.$e->getMessage();
        }
    }

    public function listCoursesbyTags() {
        try {
            $courses = $this->courseModel->getCoursesWithTags();
            return $courses;
        } catch (\Exception $e) {
            return 'error '.$e->getMessage();
        }
        
    }

    public function suppressionCourse($id) {
        try {
            $supprimerCourse = $this->courseModel->supprimerCourse($id);
            return $supprimerCourse;
        } catch (\Exception $e) {
            return 'error '.$e->getMessage();
        }
    }

    // public function addCourse() {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         session_start();
    //         if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'teacher') {
    //             echo "Access denied!";
    //             return;
    //         }
    //         $courseModel = new CourseModel();
    //         $courseModel->title = $_POST['title'];
    //         $courseModel->description = $_POST['description'];
    //         $courseModel->content = $_POST['content'];
    //         $courseModel->teacher_id = $_SESSION['user']['id'];
    //         if ($courseModel->addCourse()) {
    //             echo "Course added successfully!";
    //         } else {
    //             echo "Failed to add course.";
    //         }
    //     } else {
    //         include 'views/add_course.php';
    //     }
    // }

    // public function enrollCourse($courseId) {
    //     session_start();
    //     if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
    //         echo "Access denied!";
    //         return;
    //     }
    //     $enrollmentModel = new Enrollment();
    //     $enrollmentModel->student_id = $_SESSION['user']['id'];
    //     $enrollmentModel->course_id = $courseId;
    //     if ($enrollmentModel->enroll()) {
    //         echo "Enrolled successfully!";
    //     } else {
    //         echo "Failed to enroll.";
    //     }
    // }

    // public function myCourses() {
    //     session_start();
    //     if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student') {
    //         echo "Access denied!";
    //         return;
    //     }
    //     $enrollmentModel = new Enrollment();
    //     $courses = $enrollmentModel->getEnrolledCourses($_SESSION['user']['id']);
    //     include 'views/my_courses.php';
    // }
}
?>
