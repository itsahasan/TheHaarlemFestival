<?php
declare(strict_types=1);

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../services/LoginService.php';
require_once __DIR__ . '/../services/EmailService.php';
require_once __DIR__ . '/../models/User.php';

class LoginController extends BaseController
{
    // Свойства должны быть объявлены здесь
    private LoginService $loginService;
    private EmailService $emailService;

    public function __construct()
    {
        parent::__construct();
        // И инициализированы здесь
        $this->loginService = new LoginService();
        $this->emailService = new EmailService();
    }

    public function index()
    {
        require __DIR__ . '/../views/login/index.php';
    }

    public function validate()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /login');
            exit;
        }

        $username = $this->getPost('username');
        $password = trim($_POST['password'] ?? '');

        $user = $this->loginService->verifyUser($username, $password);

        if ($user) {
            $_SESSION['userId'] = $user->getId();
            $_SESSION['role'] = $user->getRoleId();
            $_SESSION['userEmail'] = $user->getEmail();
            $_SESSION['userName'] = $user->getUsername();
            header('Location: /');
            exit;
        } else {
            $_SESSION['error_message'] = 'Login error: Username or password incorrect.';
            header('Location: /login');
            exit;
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            require __DIR__ . '/../views/login/register.php';
            return;
        }

        $username = $this->getPost('username');
        $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password) || !$email) {
            $_SESSION['error_message'] = 'All fields are required and email must be valid.';
            header('Location: /login/register'); exit;
        }
        if ($this->loginService->getByUsername($username)) {
            $_SESSION['error_message'] = 'This username is already taken.';
            header('Location: /login/register'); exit;
        }
        if ($this->loginService->getByEmail($email)) {
            $_SESSION['error_message'] = 'This email is already registered.';
            header('Location: /login/register'); exit;
        }

        if ($this->loginService->register($username, $password)) {
            $_SESSION['success_message'] = 'Registration successful! Please log in.';
            header('Location: /login');
            exit;
        } else {
            $_SESSION['error_message'] = 'An error occurred during registration.';
            header('Location: /login/register');
            exit;
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: /');
        exit;
    }

    // ## Password Reset Methods ##

    public function resetpassword()
    {
        require __DIR__ . '/../views/login/resetpassword.php';
    }

    public function createCode()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /login/resetpassword');
            exit;
        }

        try {
            $username = $this->getPost('username');
            $user = $this->loginService->getByUsername($username);

            if (!$user) {
                throw new Exception("User with this username was not found.");
            }

            $verificationCode = mt_rand(100000, 999999);
            if (!$this->loginService->createVerificationCode($verificationCode, $user->getId())) {
                throw new Exception("Could not generate a verification code.");
            }

            // Здесь происходит вызов $this->emailService
            if ($this->emailService->sendPasswordResetEmail($user, $verificationCode)) {
                $_SESSION['success_message'] = 'A password reset link has been sent to your email.';
                header('Location: /login');
            } else {
                throw new Exception("Could not send email. Please check server configuration.");
            }
            exit;

        } catch (Exception $e) {
            $_SESSION['error_message'] = "Error: " . $e->getMessage();
            header('Location: /login/resetpassword');
            exit;
        }
    }

    public function verifyCode()
    {
        $code = (int)($_GET['code'] ?? 0);
        $user = $this->loginService->isValid($code);

        if (!$user) {
            $_SESSION['error_message'] = 'The verification code is invalid or has expired.';
            header('Location: /login');
            exit;
        }

        $_SESSION['reset_user_id'] = $user->getId();
        require __DIR__ . '/../views/login/newpassword.php';
    }

    public function updatePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /login');
            exit;
        }

        $userId = (int)($_SESSION['reset_user_id'] ?? 0);
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirmPassword'] ?? '';

        if ($userId === 0) {
            $_SESSION['error_message'] = 'Session expired. Please try again from the beginning.';
            header('Location: /login/resetpassword');
            exit;
        }
        if (empty($password) || $password !== $confirmPassword) {
            $_SESSION['error_message'] = 'Passwords do not match. Please try again.';
            header('Location: /login/resetpassword');
            exit;
        }

        if ($this->loginService->updatePassword($userId, $password)) {
            unset($_SESSION['reset_user_id']);
            $this->loginService->deleteCode($userId);
            $_SESSION['success_message'] = 'Password updated successfully! You can now log in with your new password.';
            header('Location: /login');
            exit;
        } else {
            $_SESSION['error_message'] = 'Could not update password.';
            header('Location: /login');
            exit;
        }
    }
}