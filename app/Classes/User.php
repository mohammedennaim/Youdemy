<?php

namespace App\Classes;


abstract class User {
    protected $id;
    protected $name;
    protected $email;
    protected $password;
    protected $role;
    
    public function __construct($id, $name, $email, $password, $role) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }


    abstract public function getId();
    abstract public function getName();
    abstract public function getEmail();
    abstract public function getPassword();
    abstract public function getRole();
    
}