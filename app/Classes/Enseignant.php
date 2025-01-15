<?php
namespace App\Classes;
use App\Classes\User;

class Enseignant extends User {
    private $subject;
    private $name;

    public function __construct($id, $email, $password, $name, $subject) {
        parent::__construct($id, $email, $password, 'enseignant');
        $this->subject = $subject;
        $this->name = $name;
    }

    public function getSubject() {
        return $this->subject;
    }

    public function setSubject($subject) {
        $this->subject = $subject;
    }

    // Implémentation des méthodes abstraites
    public function getDetails() {
        return "Enseignant: {$this->name}, Email: {$this->email}, Matière: {$this->subject}";
    }

    public function updateRole($role) {
        $this->role = $role;
    }

    public function getName() {
        return $this->name;
    }
}