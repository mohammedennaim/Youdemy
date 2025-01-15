<?php
namespace App\Classes;
use App\Classes\User;

class Administrateur extends User {
    // private $adminLevel;
    private $name;

    public function __construct($id,$name, $email, $password) {
        parent::__construct($id, $email, $password, 'administrateur');
        // $this->adminLevel = $adminLevel;
        $this->name = $name;
    }

    // public function getAdminLevel() {
    //     return $this->adminLevel;
    // }

    // public function setAdminLevel($adminLevel) {
    //     $this->adminLevel = $adminLevel;
    // }

    public function getDetails() {
        return "Administrateur: {$this->name}, Email: {$this->email}, Niveau: {$this->adminLevel}";
    }

    public function updateRole($role) {
        $this->role = $role;
    }

    public function getName() {
        return $this->name;
    }
}