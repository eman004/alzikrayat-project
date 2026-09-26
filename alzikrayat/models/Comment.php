<?php
require_once __DIR__ . '/../core/Model.php';
class Comment extends Model {
    public function getByPhotoId($photoId) {
        $sql = "SELECT comments.*, users.first_name, users.last_name FROM comments JOIN users ON comments.user_id = users.id WHERE photo_id = ? ORDER BY date_time ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$photoId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>