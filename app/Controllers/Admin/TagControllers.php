<?php
    namespace App\Controllers\Admin;
    
    use App\Models\tagModel;
    
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
    }