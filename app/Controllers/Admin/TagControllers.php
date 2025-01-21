<?php
    namespace App\Controllers\Admin;
    
    use App\Models\TagModel;
    
    class TagControllers {
        private $tag;
    
        public function __construct() {
            $this->tag = new tagModel();
        }
    
        public function allTags() {
            try {
                $tags = $this->tag->fetchAllTags();
                return $tags;
            } catch (\Exception $e) {
                return 'error '. $e->getMessage();
            }
        }
    
        public function ajouter($name) {
            try {
                $result = $this->tag->ajouterTag($name);
                
                if ($result) {
                    header('refresh:0');
                    return false;
                }
            } catch (\Exception $e) {
                return 'error '.$e->getMessage();
            }
        }
    
        public function edit($id, $name) {
            try {
                $result = $this->tag->editTag($id, $name);
                return $result;
            } catch (\Exception $e) {
                return 'error '.$e->getMessage();
            }
        }

        public function delete($id) {

            try {
                $result = $this->tag->deleteTag($id);
            
                return $result;
            } catch (\Exception $e) {
                return 'error '.$e->getMessage();
            }
        }

        public function findTagByName($name) {
            try {
                $tag = $this->tag->findByName($name);
                return $tag;
            } catch (\Exception $e) {
                return 'error '.$e->getMessage();
            }
        }
    
        public function findTagById($id) {
            try {
                $row = $this->tag->findById($id);
                return $row;
            } catch (\Exception $e) {
                return 'error '.$e->getMessage();
            }
        }
        public function getAllTags()
    {
        try {
            $tags = $this->tag->fetchAllTags();
            return $tags;
        } catch (\Exception $e) {
            return 'error ' . $e->getMessage();
        }
    }

    public function getCourseById($id){
        try {
            $course = $this->tag->CourseById($id);
            return $course;
        } catch (\Exception $e) {
            return 'error ' . $e->getMessage();
        }
    }
    public function listCoursesbyTags()
    {
        try {
            $courses = $this->tag->getCoursesWithTags();
            return $courses;
        } catch (\Exception $e) {
            return 'error ' . $e->getMessage();
        }

    }

    public function suppressionCourse($id)
    {
        try {
            $supprimerCourse = $this->tag->supprimerCourse($id);
            return $supprimerCourse;
        } catch (\Exception $e) {
            return 'error ' . $e->getMessage();
        }
    }
    public function deleteCourse($id)
    {
        try {
            $result = $this->tag->supprimerCourse($id);

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