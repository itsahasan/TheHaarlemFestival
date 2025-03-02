<?php

use PHPMailer\Mailer;

require __DIR__ . '/../utils/mailer.php';
require __DIR__ . '/../services/userservice.php';

class UserController
{
    private $userService;
    private $mailer;

    function __construct()
    {
        $this->userService = new UserService();
        $this->mailer = new Mailer();
        session_start();
    }

    public function index()
    {
        $model = $this->userService->getAll();
        //$roles = $this->userService->getRoles();

        require __DIR__ . '/../views/cms/user/index.php';
    }
    public function displayCreate()
    {
        $roles = $this->userService->getRoles();

        require __DIR__ . '/../views/cms/user/create.php';
    }
    public function edit()
    {
        $user = $this->userService->getById($_GET['userId']);
        $roles = $this->userService->getRoles();

        require __DIR__ . '/../views/cms/user/edit.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $newUser = new User();
                $newUser->setUsername(htmlspecialchars(isset($_POST['username']) ? $_POST['username'] : ""));
                $hashedPass = isset($_POST['password']) ? $_POST['password'] : "";
                $newUser->setPassword($hashedPass);
                $newUser->setEmail(htmlspecialchars(isset($_POST['email']) ? $_POST['email'] : ""));
                $newUser->setRole(htmlspecialchars(isset($_POST['role']) ? $_POST['role'] : 2)); //default customer

                if ($this->userService->getByUsername($newUser->getUsername())) {
                    echo "<script>alert('Username already in use!'); window.location = '/user/displayCreate';</script>";
                } else if ($this->userService->getByEmail($newUser->getEmail())) { //returns true if username or email exist in db
                    echo "<script>alert('Email already in use!'); window.location = '/user/displayCreate';</script>";
                } else if (!$this->userService->create($newUser)) {
                    echo "<script>alert('An error occurred while creating the user.'); window.location = '/user/displayCreate';</script>";
                } else {
                    echo "<script>alert('Created successfully!'); window.location = '/user';</script>";
                }
            } catch (Exception $e) {
                echo "An error occurred: " . $e->getMessage();
            }
        }
    }
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $newUser = new User();
                $newUser->setId(htmlspecialchars(isset($_POST['id']) ? $_POST['id'] : ""));
                $newUser->setUsername(htmlspecialchars(isset($_POST['username']) ? $_POST['username'] : ""));
                $password = isset($_POST['password']) ? $_POST['password'] : "";
                $newUser->setPassword(password_hash($password, PASSWORD_DEFAULT));
                $newUser->setEmail(htmlspecialchars(isset($_POST['email']) ? $_POST['email'] : ""));
                $newUser->setRole(htmlspecialchars(isset($_POST['role']) ? $_POST['role'] : 2)); //default customer

                //prepare email
                $existingUser = $this->userService->getById($newUser->getId());
                $receiver = $existingUser->getEmail();
                $receiver_name = $newUser->getUsername();
                $subject = "Password changed - Haarlem Festival Support";
                $body_string = 'Your password has been changed.';
                $attachment = ""; //no attachment

                if (strlen($newUser->getPassword() < 6) && strlen($newUser->getPassword() > 0)) {
                    echo "<script>alert('Password must be at least 6 characters long!'); window.location = '/user';</script>";
                } else if ($this->userService->validateUser($newUser, $_POST['id'])) { //returns true if user.username and user.email do not exist in db excluding id
                    echo "<script>alert('Username or Email already in use!'); window.location = '/user';</script>";
                } else if (!$this->mailer->sendEmail($receiver, $receiver_name,  $subject, $body_string, $attachment, '')) {
                    echo "<script>alert('Error while sending confirmation email'); window.location = '/user';</script>";
                } else if (!$this->userService->update($newUser)) {
                    echo "<script>alert('Failed to update User. '); window.location = '/user';</script>";
                } else {
                    echo "<script>alert('Updated successfully!'); window.location = '/user';</script>";
                }
            } catch (Exception $e) {
                echo "An error occurred: " . $e->getMessage();
            }
        }
    }

    public function delete()
    {
        require __DIR__ . '/../views/cms/user/delete.php';
        $userId = $_GET['userId'];
        if ($this->userService->deleteById($userId)) {
            echo "<script>alert('User deleted successfully. ')</script>";
        } else {
            echo "<script>alert('Failed to delete User. ')</script>";
        }
    }

    public function profile()
    {
        if (isset($_SESSION['userId'])) {
            $user = $this->userService->getById($_SESSION['userId']);
            require __DIR__ . '/../views/cms/user/profile.php';
        } else {
            echo "<script>alert('Please log in to access profile!'); window.location = '/page/festival';</script>";
        }
    }
}
