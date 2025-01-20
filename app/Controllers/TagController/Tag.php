<?php
namespace App\Controllers\TagController;
use App\Models\TagModel;

class Tag
{
    private $tagModel;
    public function __construct()
    {
        $this->tagModel = new TagModel();
    }
    public function getAllTags()
    {
        try {
            $tags = $this->tagModel->fetchAllTags();
            return $tags;
        } catch (\Exception $e) {
            return 'error ' . $e->getMessage();
        }
    }

    public function getCourseById($id){
        try {
            $course = $this->tagModel->CourseById($id);
            return $course;
        } catch (\Exception $e) {
            return 'error ' . $e->getMessage();
        }
    }
    public function listCoursesbyTags()
    {
        try {
            $courses = $this->tagModel->getCoursesWithTags();
            return $courses;
        } catch (\Exception $e) {
            return 'error ' . $e->getMessage();
        }

    }

    public function suppressionCourse($id)
    {
        try {
            $supprimerCourse = $this->tagModel->supprimerCourse($id);
            return $supprimerCourse;
        } catch (\Exception $e) {
            return 'error ' . $e->getMessage();
        }
    }
    public function deleteCourse($id)
    {
        try {
            $result = $this->courseModel->supprimerCourse($id);

            if ($result) {
                echo "Le cours a été supprimé avec succès.";
            } else {
                echo "Échec de la suppression du cours.";
            }
        } catch (\Exception $e) {
            return 'error ' . $e->getMessage();
        }
    }
}
?>