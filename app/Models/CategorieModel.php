<?php
namespace App\Models;
use App\Config\Database;
use App\Classes\Categorie;
use PDO;

class CategorieModel
{
    private $conn;
    public function __construct() {        
      $this->conn= Database::connection();
    }
    public function fetchAllCategories() {
  
        $query = "SELECT c.id as id, c.name as name FROM categories as c";        

        $stmt = $this->conn->prepare($query); 
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $categories = [];
        
        if (!$rows) {
            return null;
        } else {
            foreach ($rows as $row) {
                $categories[] = new Categorie($row['id'], $row["name"]);
            }
            return $categories;
        }
     }
     
    public function findByName($name) {
        $stmt = $this->conn->prepare("SELECT * FROM categories WHERE name = :name");
        $stmt->bindParam(':name', $name);
        $stmt->execute(); 
    

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result; 
    }

    public function findById($id) {
        
        $stmt = $this->conn->prepare("SELECT name FROM categories WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute(); 
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result; 
    }     
    public function ajouterCategorie($name){
        $query = "INSERT INTO categories (name) VALUES (:name);";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name',$name);
        $stmt->execute();
    }
    public function editCategorie($id, $name){
        $query = "UPDATE categories SET name = :name where id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
    }
    public function deleteCategorie($id){
        $stmt = $this->conn->prepare("DELETE FROM categories WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

}


