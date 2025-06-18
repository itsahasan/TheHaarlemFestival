<?php

use PHPMailer\Mailer;

require __DIR__ . '/../services/loginservice.php';
require __DIR__ . '/../services/shoppingcartservice.php';

require __DIR__ . '/../utils/mailer.php';

class LoginController
{
    private $loginService;
    private $shoppingcartService;
    private $mailer;

    function __construct()
    {
        $this->loginService = new LoginService();
        $this->shoppingcartService = new ShoppingCartService();
        $this->mailer = new Mailer();
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

        $username = $this->getPost('username'); // Используем безопасный метод из BaseController
        $password = $_POST['password'] ?? ''; // Берем пароль как есть
        $user = $this->loginService->getByUsername($username);

        // Проверяем пользователя и пароль
        if ($user && password_verify($password, $user->getPassword())) {
            // Успешный вход
            $_SESSION['userId'] = $user->getId();
            $_SESSION['role'] = $user->getRole();
            $_SESSION['userEmail'] = $user->getEmail();
            $_SESSION['userName'] = $user->getUsername(); // Добавим для удобства

            // Считаем товары в корзине
            $shoppingCartCount = $this->shoppingCartService->countProducts($user->getId());
            $_SESSION['cartCount'] = $shoppingCartCount;

            header('Location: /'); // Редирект на главную страницу
            exit;
        } else {
            // Неуспешный вход
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
        $email = $this->getPost('email');
        $password = $_POST['password'] ?? '';

        // Валидация
        if (empty($username) || empty($email) || empty($password)) {
            $_SESSION['error_message'] = 'All fields are required.';
            header('Location: /login/register'); exit;
        }
        if (strlen($password) < 6) {
            $_SESSION['error_message'] = 'Password must be at least 6 characters long.';
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

        // Регистрация
        $hashedPass = password_hash($password, PASSWORD_DEFAULT);
        if ($this->loginService->register($username, $hashedPass, $email)) {
            $_SESSION['success_message'] = 'Registration successful! Please log in.';
            header('Location: /login');
            exit;
        } else {
            $_SESSION['error_message'] = 'An error occurred during registration.';
            header('Location: /login/register');
            exit;
        }
    }

    public function display()
    {
        require __DIR__ . '/../views/login/register.php';
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: /');
        exit;
    }

    public function createCode()
    {
        try {
            $username = isset($_POST['username']) ? $_POST['username'] : "";

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['username'] != null) {
                session_start();

                $user = $this->loginService->getByUsername($username);
                $_SESSION['username'] = $user->getUsername();
                $verificationCode = mt_rand(100000, 999999);

                $receiver = $user->getEmail();
                $receiver_name = $user->getUsername();
                $subject = "Verification Code - Haarlem Festival Support";
                $link = "http://localhost/login/verifyCode?code=" . $verificationCode; //replace localhost with domain name
                $body_string = 'Click on the link to reset your password: ' . $link;
                $attachment = "";

                if (!$this->loginService->createVerificationCode($verificationCode, $user->getId()) || !$this->mailer->sendEmail($receiver, $receiver_name,  $subject, $body_string, $attachment, '')) {
                    echo "<script>alert('Error while sending email'); window.location = '/login/createCode';</script>";
                } else {
                    echo "<script>alert('Email sent successfully! You can now close this window'); window.location = '/login/';</script>";
                }
            }
        } catch (Exception $e) {
            echo $e;
        }
        require __DIR__ . '/../views/login/resetpassword.php';
    }

    public function verifyCode()
    {
        try {
            $code = isset($_GET['code']) ? $_GET['code'] : "";
            $user = $this->loginService->isValid($code);

            if (!$user) {
                echo "<script>alert('Error validating code'); window.location = '/login';</script>";
            } else {
                require __DIR__ . '/../views/login/newpassword.php';
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function updatePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userId = $_POST['userId'];
            $password1 = $_POST['password'];
            $password2 = $_POST['confirmPassword'];

            if ($password1 == $password2) {
                $password = password_hash($password1, PASSWORD_DEFAULT);
                $this->loginService->updatePassword($userId, $password);
                $newUser = $this->loginService->getById($userId);

                if (!$newUser) {
                    echo "<script>alert('Error updating password'); window.location = '/login/updatePassword';</script>";
                }
                if (password_verify($password1, $newUser->getPassword())) {
                    //send confirmation email
                    echo "<script>alert('Password updated successfully!'); window.location = '/login';</script>";
                }
                //$this->loginService->deleteCode($userId);
            } else {
                echo "Passwords do not match!";
            }
        }
    }
}
