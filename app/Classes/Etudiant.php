<?php
namespace App\Classes;
use App\Classes\User;

class Etudiant extends User {
    private $studentNumber;
    private $name;

    public function __construct($id, $email, $password, $name, $studentNumber) {
        parent::__construct($id, $email, $password, 'etudiant', );
        $this->studentNumber = $studentNumber;
        $this->name = $name;
    }

    public function getStudentNumber() {
        return $this->studentNumber;
    }

    public function setStudentNumber($studentNumber) {
        $this->studentNumber = $studentNumber;
    }

    // Implémentation des méthodes abstraites
    public function getDetails() {
        return "Étudiant: {$this->name}, Email: {$this->email}, Numéro étudiant: {$this->studentNumber}";
    }

    public function updateRole($role) {
        $this->role = $role;
    }

    public function getName() {
        return $this->name;
    }
}