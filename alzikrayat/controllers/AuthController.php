<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/User.php';

/**
 * AuthController
 * Handles user registration, secure login, sessions, and cookies.
 */
class AuthController extends Controller {

    public function showLogin() {
        // Read the last login cookie (expires in 7 days)
        $lastLogin = $_COOKIE['last_login'] ?? 'Never';
        $this->view('auth/login', ['lastLogin' => $lastLogin]);
    }

    public function login() {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $userModel = new User();
        $user = $userModel->findByEmail($email);

        // Verify password hash safely
        if ($user && password_verify($password, $user['password'])) {
            // Save user details in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['email'] = $user['email'];

            // Set Last Login Cookie valid for 7 days
            $timestamp = date('Y-m-d H:i:s');
            setcookie('last_login', $timestamp, time() + (7 * 24 * 60 * 60), "/");

            header('Location: /alzikrayat/public/');
            exit;
        } else {
            $this->view('auth/login', [
                'error' => 'Invalid email or password',
                'lastLogin' => $_COOKIE['last_login'] ?? 'Never'
            ]);
        }
    }

    public function showRegister() {
        $this->view('auth/register');
    }

    public function register() {
        // Hash password securely using Bcrypt (non-retrievable)
        $passwordHash = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $data = [
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'email' => $_POST['email'],
            'password' => $passwordHash,
            'location' => $_POST['location'] ?? null,
            'description' => $_POST['description'] ?? null,
            'occupation' => $_POST['occupation'] ?? null
        ];

        $userModel = new User();
        if ($userModel->create($data)) {
            header('Location: /alzikrayat/public/login');
            exit;
        } else {
            $this->view('auth/register', ['error' => 'Registration failed. Email may already be in use.']);
        }
    }

    public function logout() {
        session_destroy();
        header('Location: /alzikrayat/public/login');
        exit;
    }
}
?>