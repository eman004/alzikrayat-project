<?php
require_once __DIR__ . '/../core/Model.php';

class Photo extends Model {
    
    // Fetch all photos along with author names
    public function getAll() {
        $sql = "SELECT photos.*, users.first_name, users.last_name FROM photos JOIN users ON photos.user_id = users.id ORDER BY photos.date_time DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Find single photo by ID
    public function findById($id) {
        $sql = "SELECT photos.*, users.first_name, users.last_name FROM photos JOIN users ON photos.user_id = users.id WHERE photos.id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Insert new photo metadata
    public function create($data) {
        $sql = "INSERT INTO photos (user_id, file_name, title, description) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['user_id'],
            $data['file_name'],
            $data['title'],
            $data['description']
        ]);
    }

    // Delete photo record
    public function delete($id) {
        $sql = "DELETE FROM photos WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>