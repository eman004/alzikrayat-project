<?php
require_once __DIR__ . '/../config/database.php';

/**
 * Abstract Base Model
 * Provides database connection access to all child models.
 */
abstract class Model {
    protected $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
}
?>