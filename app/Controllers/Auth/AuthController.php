<?php
namespace App\Controllers\Auth;

use App\Models\AuthModel;

class AuthController {
public function login($email, $password) {
    try {
        $auth = new AuthModel();
        $user = $auth->findUserByEmailAndPassword($email, $password);
        if ($user !== null) {
            $role = $user->getRole();
            $id = $user->getId();

            session_name('session_' . $role);
            session_start();

            $_SESSION["id"] = $id;
            $_SESSION["role"] = $role;

            switch ($role) {
                case "administrateur":
                    header("Location: ../$role/dashboard/public/index.php");
                    break;
                case "enseignant":
                    header("Location: ../$role/home.php");
                    break;
                case "etudiant":
                    header("Location: ../$role/home.php");
                    break;
                default:
                    header("Location: home.php");
                    break;
            }
            exit();
        } else {
            throw new \Exception("Email ou password incorrect.");
        }
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}

    public function signUp($name, $email, $password, $role) {
        try {
            $userModel = new AuthModel();

            $userSignUp = $userModel->findUserByEmailAndPassword($email, $password);

            if ($userSignUp === null) {
                $userModel->register($name, $email, $password, $role);
                header("Location: ../auth/login.php");
                exit();
            } else {
                throw new \Exception("Cet email existe déjà.");
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}