<?php
namespace App\Controllers\Auth;

use App\Models\AuthModel;

    // public function login($email, $password) {
        
    //         $auth = new AuthModel();
    //         $user = $auth->findUserByEmailAndPassword($email,$password);
            
    //         if ($user !== null && password_verify($password, $user->getPassword())) {
    //             $role = $user->getRole();
    //             $id = $user->getId();
    //             session_start();
    //             $_SESSION["id"] = $id;
    //             $_SESSION["role"] = $role;

                
    //             switch ($role) {
    //                 case "administrateur":
    //                     header("Location: ../administrateur/dashboard/public/index.php");
    //                     break;
    //                 case "enseignant":
    //                     header("Location: ../enseignant/home.php");
    //                     break;
    //                 case "etudiant":
    //                     header("Location: ../etudiant/home.php");
    //                     break;
    //                 default:
    //                     header("Location: ../home.php");
    //                     break;
    //             }
    //             exit();
    //         } else {
    //             throw new \Exception("Email or password incorrect.");
    //         }
    // }
    
class AuthController {

    public function login($email, $password) {

        $auth = new AuthModel();
        $user = $auth->findUserByEmailAndPassword($email, $password);

        if ($user !== null) {
            $role = $user->getRole();
            $id = $user->getId();

            $userStatus = $auth->getUserStatus($id);
            if ($userStatus === 'inactive') {
                header("Location: /auth/waiting_activation.php");
                throw new \Exception("Votre compte est en attente d'activation. Veuillez contacter l'administrateur.");
            }

            session_start();

            $_SESSION["id"] = $id;
            $_SESSION["role"] = $role;

            switch ($role) {
                case "administrateur":
                    header("Location: ../administrateur/dashboard/public/index.php");
                    break;
                case "enseignant":
                    header("Location: ../enseignant/home.php");
                    break;
                case "etudiant":
                    header("Location: ../etudiant/home.php");
                    break;
                default:
                    header("Location: ../home.php");
                    break;
            }
            exit();
        } else {
            throw new \Exception("Email ou mot de passe incorrect.");
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