<?php
namespace App\Models;
use App\Config\Database;
use App\Classes\Tag;
use PDO;

class TagModel
{
    private $conn;
    public function __construct() {        
      $this->conn= Database::connection();
    }
    public function fetchAllTags() {
  
        $query = "SELECT * from tags";        

        $stmt = $this->conn->prepare($query); 
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $tags = [];
        
        if (!$rows) {
            return null;
        } else {
            foreach ($rows as $row) {
                $tags[] = new Tag($row['id'], $row["name"]);
            }
            return $tags;
        }
     }
     
    public function findByName($name) {
        $stmt = $this->conn->prepare("SELECT * FROM tags WHERE name = :name");
        $stmt->bindParam(':name', $name);
        $stmt->execute(); 
    

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result; 
    }

    public function findById($id) {
        
        $stmt = $this->conn->prepare("SELECT name FROM tags WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute(); 
        

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result; 
    }     
     
    public function ajouterTag($name){
        $query = "INSERT INTO tags (name) VALUES (:name);";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name',$name);
        $stmt->execute();
    }
    public function editTag($id, $name){
        $query = "UPDATE tags SET name = :name where id = $id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name',$name);
        $stmt->execute();

    }
    public function deleteTag($id){

        $stmt = $this->conn->prepare("DELETE FROM tags WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

}


