<?php
namespace App\Models;

use App\Classes\Administrateur;
use App\Classes\Enseignant;
use App\Classes\Etudiant;
use App\Config\Database;
use PDO;

class AuthModel {
   
    private $conn;

    public function __construct() {
        $this->conn = Database::connection();
    }

    public function findUserByEmailAndPassword($email, $password) {
 
     $query = "SELECT * FROM users WHERE email = :email";
     $stmt = $this->conn->prepare($query);
     $stmt->bindParam(':email', $email);
     $stmt->execute();
 
     $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
     if (!$row) {
         return null; 
     }
 
     if (password_verify($password, $row["password"])) {
         switch ($row["role"]) {
             case "administrateur":
                 return new Administrateur($row['id'], $row["name"], $row["email"], $row["password"], $row["role"]);
             case "enseignant":
                 return new Enseignant($row['id'], $row["email"], $row["password"], $row["name"], $row["role"]);
             case "etudiant":
                 return new Etudiant($row['id'], $row["email"], $row["password"], $row["name"], $row["role"]);
             default:
                 return null; // Rôle non reconnu
         }
     } else {
         return null; // Mot de passe incorrect
     }
    }

    public function register($name, $email, $password, $role) {

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $status = ($role === 'enseignant') ? 'inactive' : 'active';

        $query = "INSERT INTO users (name, email, password, role, status) VALUES (:name, :email, :password, :role, :status)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hash);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':status', $status);
    

        if ($stmt->execute()) {
            $userId = $this->conn->lastInsertId();
            switch ($role) {
                case "administrateur":
                    return new Administrateur($userId, $name, $email, $hash, $role);
                case "enseignant":
                    return new Enseignant($userId, $email, $hash, $name, $role);
                case "etudiant":
                    return new Etudiant($userId, $email, $hash, $name, $role);
                default:
                    header("Location: login.php");
                    break;
            }
            exit();
        }
        return null;
    }
    public function getUserStatus($userId) {
      $query = "SELECT status FROM users WHERE id = :id";
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
      $stmt->execute();
  
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      return $row ? $row['status'] : null;
  }
}