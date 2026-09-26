<?php
/**
 * Abstract Base Controller
 * Handles loading views and passing data to them.
 */
abstract class Controller {
    
    // Helper method to render view files
    protected function view($viewName, $data = []) {
        // Extract data array keys into variables for the view
        extract($data);
        
        $viewFile = __DIR__ . '/../views/' . $viewName . '.php';
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            echo "View not found: " . $viewName;
        }
    }
}
?>