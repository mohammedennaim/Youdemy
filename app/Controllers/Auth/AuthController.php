<?php
namespace App\Controllers\Auth;

use App\Models\AuthModel;

class AuthController {
    public function login($email, $password) {
        $auth = new AuthModel();
        $user = $auth->findUserByEmailAndPassword($email, $password);
        if ($user !== null) {
            $role = $user->getRole();
            $id = $user->getId();
            
            session_start();
            $_SESSION["id"] = $id;
            $_SESSION["role"] = $role;

            switch ($role) {
                case "admin":
                    header("Location: ../$role/dashboard/public/index.php");
                    break;
                case "teacher":
                    header("Location: ../$role/home.php");
                    break;
                case "student":
                    header("Location: ../$role/home.php");
                    break;
                default:
                    header("Location: login.php");
                    break;
            }
            exit();
        } else {
            echo "Cette personne n'existe pas.";
        }
    }

    public function signUp($name, $email, $password, $role) {
        $userModel = new AuthModel();
        
        $userSignUp = $userModel->findUserByEmailAndPassword($email, $password);
        
        if ($userSignUp === null) {
            $userModel->register($name, $email, $password, $role);
            header("Location: ../$role/home.php");
            exit();
        } else {
            echo "Cet email existe déjà.";
        }
    }

}
