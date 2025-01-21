<?php
namespace App\Models;

use App\Config\Database;
use PDO;

class UserModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::connection();
    }

    public function getAllUsers(): array {
        $query = "SELECT id, name, email, role, status FROM users WHERE status != 'deleted'";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id): ?array {
        if (!is_numeric($id)) {
            throw new \InvalidArgumentException("Invalid user ID");
        }

        $query = "SELECT id, name, email, role, status FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUserStatus($id, $status): bool {
        if (!is_numeric($id)) {
            throw new \InvalidArgumentException("Invalid user ID");
        }

        $validStatuses = ['active', 'inactive', 'suspended', 'deleted'];
        if (!in_array($status, $validStatuses)) {
            throw new \InvalidArgumentException("Invalid status");
        }

        $query = "UPDATE users SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteUser($id): bool {
        return $this->updateUserStatus($id, 'deleted');
    }

    public function activateUser($id): bool {
        return $this->updateUserStatus($id, 'active');
    }

    public function suspendUser($id): bool {
        return $this->updateUserStatus($id, 'suspended');
    }

    public function deactivateUser($id): bool {
        return $this->updateUserStatus($id, 'inactive');
    }
}