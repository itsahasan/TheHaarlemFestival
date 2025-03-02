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
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $username = isset($_POST['username']) ? $_POST['username'] : "";
                $password = isset($_POST['password']) ? $_POST['password'] : "";
                $user = $this->loginService->getByUsername($username);
                if ($user != null) {
                    if (password_verify($password, $user->getPassword())) {
                        session_start();
                        $_SESSION['userId'] = $user->getId();
                        $_SESSION['role'] = $user->getRole();
                        $_SESSION['userEmail'] = $user->getEmail();
                        $_SESSION['loggedin'] = true;
                        $shoppingCartCount = $this->shoppingcartService->countProducts($_SESSION['userId']);
                        $_SESSION['cartcount'] = $shoppingCartCount;
                        header('Location: /page');
                    }
                }
                echo "Login error: Username or password incorrect.";
                $this->index();
            }
        } catch (Exception $e) {
            echo "An error occurred: " . $e->getMessage();
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $username = $_POST['username'];

            $password = $_POST['password'];
            $hashedPass = password_hash($password, PASSWORD_DEFAULT);

            $email = $_POST['email'];

            // Validate updated information
            if (empty($email) || !$this->loginService->getByEmail($email) == null) {
                echo "<script>alert('email already exists!')</script>";
                echo $this->display();
            } else if (empty($username) || !$this->loginService->getByUsername($username) == null) {
                echo "<script>alert('username already exists!')</script>";
                $this->display();
            } else if (strlen($password) < 6) {
                echo "<script>alert('Password must be at least 6 characters long.')</script>";
                $this->display();
            } else {
                if ($this->loginService->register($username, $hashedPass, $email)) {
                    echo "<script>alert('Register successful! ')</script>";
                    $this->index();
                }
            }
        }
    }

    public function display()
    {
        require __DIR__ . '/../views/login/register.php';
    }

    public function logout()
    {
        require __DIR__ . '/../views/login/logout.php';
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
