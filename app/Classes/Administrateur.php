<?php
namespace App\Classes;
use App\Classes\User;

class Administrateur extends User {
    private $name;

    public function __construct($id,$name, $email, $password) {
        parent::__construct($id, $email, $password, 'administrateur');
        $this->name = $name;
    }

    public function __tostring() {
        return "Administrateur: {$this->name}, Email: {$this->email}";
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