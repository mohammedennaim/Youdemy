<?php
namespace App\Models;

use App\Classes\Administrateur;
use App\Config\Database;
use PDO;

class AuthModel{
   private $conn;

   public function __construct() {
      $this->conn= Database::connection();
   }

   public function findUserByEmailAndPassword($email, $password) {
      $query = "SELECT id, name, email, password, role FROM users WHERE email = :email";        

      $stmt = $this->conn->prepare($query); 
      $stmt->bindParam(':email', $email);
      $stmt->execute();
      
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      if (!$row) {
          return null;
      } else {
         if ($email == $row["email"] && password_verify($password, $row["password"])) {
            return new Administrateur($row['id'], $row["email"], $row["role"], $row["password"]);
         } else {
            return null;
         }
      }
   }

   public function register($name, $email, $password, $role) {
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $query = "INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role);";
      $stmt = $this->conn->prepare($query);
  
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':password', $hash);
      $stmt->bindParam(':role', $role);

      if ($stmt->execute()) {
         
         $userId = $this->conn->lastInsertId();
         return new Administrateur($userId, $email, $hash, $role);
      }
      return null;
  }
}