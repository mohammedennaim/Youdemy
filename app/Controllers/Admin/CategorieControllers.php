<?php
    namespace App\Controllers\Admin;
    
    use App\Models\CategorieModel;
    
    class CategorieControllers {
        private $categorie;
    
        public function __construct() {
            $this->categorie = new CategorieModel();
        }
    
        public function allCategories() {
            try {
                $categories = $this->categorie->fetchAllCategories();
                return $categories;
            } catch (\Exception $e) {
                return 'error '. $e->getMessage();
            }
        }
    
        public function ajouter($name) {
            try {
                $result = $this->categorie->ajouterCategorie($name);
                
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
                $result = $this->categorie->editCategorie($id, $name);
                return $result;
            } catch (\Exception $e) {
                return 'error '.$e->getMessage();
            }
        }

        public function delete($id) {

            try {
                $result = $this->categorie->deleteCategorie($id);
            
                return $result;
            } catch (\Exception $e) {
                return 'error '.$e->getMessage();
            }
        }

        public function findCategorieByName($name) {
            try {
                $categorie = $this->categorie->findByName($name);
                return $categorie;
            } catch (\Exception $e) {
                return 'error '.$e->getMessage();
            }
        }
    
        public function findCategorieById($id) {
            try {
                $row = $this->categorie->findById($id);
                return $row;
            } catch (\Exception $e) {
                return 'error '.$e->getMessage();
            }
        }
    }