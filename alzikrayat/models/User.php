<?php
require_once __DIR__ . '/../core/Model.php';

/**
 * User Model
 * Manages database queries for the users table.
 */
class User extends Model {
    
    // Insert a new user with a hashed password
    public function create($data) {
        $sql = "INSERT INTO users (first_name, last_name, email, password, location, description, occupation) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['password'],
            $data['location'],
            $data['description'],
            $data['occupation']
        ]);
    }

    // Find user record by email
    public function findByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>