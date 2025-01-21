<?php
namespace App\Controllers;

use App\Models\UserModel;

class UserController {
    private $userModel;

    public function __construct(UserModel $userModel) {
        $this->userModel = $userModel;
    }

    public function index() {
        $users = $this->userModel->getAllUsers();
        include __DIR__ . '/../../../Views/administrateur/dashboard/public/index.php';
    }

    public function activate($id) {
        try {
            if ($this->userModel->activateUser($id)) {
                header("Location: users.php");
                exit();
            } else {
                throw new \Exception("Erreur lors de l'activation de l'utilisateur.");
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function suspend($id) {
        try {
            if ($this->userModel->suspendUser($id)) {
                header("Location: users.php");
                exit();
            } else {
                throw new \Exception("Erreur lors de la suspension de l'utilisateur.");
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function deactivate($id) {
        try {
            if ($this->userModel->deactivateUser($id)) {
                header("Location: users.php");
                exit();
            } else {
                throw new \Exception("Erreur lors de la désactivation de l'utilisateur.");
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function delete($id) {
        try {
            if ($this->userModel->deleteUser($id)) {
                header("Location: users.php");
                exit();
            } else {
                throw new \Exception("Erreur lors de la suppression de l'utilisateur.");
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}