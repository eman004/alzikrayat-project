<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Photo.php';
require_once __DIR__ . '/../models/Comment.php';

/**
 * PhotoController
 * Manages gallery display, photo uploads, detailed views, comments integration, and deletion.
 */
class PhotoController extends Controller {

    /**
     * Display the main homepage photo gallery grid
     */
    public function index() {
        $photoModel = new Photo();
        $photos = $photoModel->getAll();
        $this->view('photos/index', ['photos' => $photos]);
    }

    /**
     * Display the static About Us page
     */
    public function about() {
        $this->view('photos/about');
    }

    /**
     * Show the upload form view (Restricted to logged-in users)
     */
    public function create() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /alzikrayat/public/login');
            exit;
        }
        $this->view('photos/create');
    }

    /**
     * Handle physical file uploads, validation, and metadata persistence
     */
    public function store() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /alzikrayat/public/login');
            exit;
        }

        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['photo']['tmp_name'];
            $fileName = $_FILES['photo']['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            
            // Validate file extensions
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array($fileExtension, $allowedExtensions)) {
                $this->view('photos/create', ['error' => 'Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.']);
                return;
            }

            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $uploadFileDir = dirname(__DIR__) . '/public/images/uploads/';
            
            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0755, true);
            }
            
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $photoModel = new Photo();
                $photoModel->create([
                    'user_id' => $_SESSION['user_id'],
                    'file_name' => $newFileName,
                    'title' => $_POST['title'] ?? '',
                    'description' => $_POST['description'] ?? ''
                ]);
                header('Location: /alzikrayat/public/');
                exit;
            }
        }
        
        $this->view('photos/create', ['error' => 'File upload failed. Please try again.']);
    }

    /**
     * Show detailed view for a single photo and its associated comments
     * 
     * @param int $id The unique ID of the photo
     */
    public function show($id) {
        $photoModel = new Photo();
        $photo = $photoModel->findById($id);

        if (!$photo) {
            header("HTTP/1.0 404 Not Found");
            echo "Photo not found";
            return;
        }

        $commentModel = new Comment();
        $comments = $commentModel->getByPhotoId($id);

        $this->view('photos/show', ['photo' => $photo, 'comments' => $comments]);
    }

    /**
     * Delete a photo record and its physical file after verifying user ownership
     * 
     * @param int $id The unique ID of the photo to delete
     */
    public function delete($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /alzikrayat/public/login');
            exit;
        }

        $photoModel = new Photo();
        $photo = $photoModel->findById($id);

        // Strict ownership verification: Only the author can delete their photo
        if ($photo && $photo['user_id'] == $_SESSION['user_id']) {
            $filePath = dirname(__DIR__) . '/public/images/uploads/' . $photo['file_name'];
            if (file_exists($filePath)) {
                unlink($filePath); // Purge physical file from disk
            }
            $photoModel->delete($id); // Purge database record
        }

        header('Location: /alzikrayat/public/');
        exit;
    }
}
?>