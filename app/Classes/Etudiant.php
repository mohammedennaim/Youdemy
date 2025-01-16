<?php
namespace App\Classes;
use App\Classes\User;

class Etudiant extends User {
    private $studentNumber;
    private $name;

    public function __construct($id, $email, $password, $role, $name, $studentNumber) {
        parent::__construct($id, $email, $password, $role, );
        $this->studentNumber = $studentNumber;
        $this->name = $name;
    }

    public function getStudentNumber() {
        return $this->studentNumber;
    }

    public function setStudentNumber($studentNumber) {
        $this->studentNumber = $studentNumber;
    }

    public function __tostring() {
        return "Étudiant: {$this->name}, Email: {$this->email}, Numéro étudiant: {$this->studentNumber}";
    }

    public function updateRole($role) {
        $this->role = $role;
    }

    public function getName() {
        return $this->name;
    }
    
    public function getId() { return $this->id; }
    public function getEmail() { return $this->email; }
    public function getPassword() { return $this->password; }
    public function getRole() { return $this->role; }
}