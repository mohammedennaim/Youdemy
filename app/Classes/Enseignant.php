<?php
namespace App\Classes;
use App\Classes\User;

class Enseignant extends User {
    private $subject;
    private $name;

    public function __construct($id, $email, $password, $role, $name, $subject) {
        parent::__construct($id, $email, $password, $role);
        $this->subject = $subject;
        $this->name = $name;
    }

    public function getSubject() {
        return $this->subject;
    }

    public function setSubject($subject) {
        $this->subject = $subject;
    }

    public function __tostring() {
        return "Enseignant: {$this->name}, Email: {$this->email}, Matière: {$this->subject}";
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