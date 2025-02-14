<?php
namespace App\Classes;
use App\Classes\User;

class Administrateur extends User {

    public function __construct($id,$name, $email, $password, $role) {
        parent::__construct($id, $name,$email, $password, $role);
    }

    public function getDetails() {
        return "Administrateur: {$this->name}, Email: {$this->email}";
    }

    public function updateRole($role) {
        $this->role = $role;
    }


    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getEmail() { return $this->email; }
    public function getPassword() { return $this->password; }
    public function getRole() { return $this->role; }
}