<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Comment.php';

class CommentController extends Controller {

    public function store() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /alzikrayat/public/login');
            exit;
        }

        $photoId = $_POST['photo_id'] ?? null;
        $commentText = $_POST['comment'] ?? '';

        if ($photoId && !empty(trim($commentText))) {
            // Basic server-side sanitization against XSS
            $commentText = htmlspecialchars($commentText, ENT_QUOTES, 'UTF-8');

            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare("INSERT INTO comments (photo_id, user_id, comment) VALUES (?, ?, ?)");
            $stmt->execute([$photoId, $_SESSION['user_id'], $commentText]);
        }

        header('Location: /alzikrayat/public/photo/' . $photoId);
        exit;
    }
}
?>