<?php

use PHPMailer\Mailer;

require __DIR__ . '/../../utils/mailer.php';
require __DIR__ . '/../../services/userservice.php';

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
        require __DIR__ . '/../../views/cms/user/index.php';
    }
    public function create()
    {
        $roles = $this->userService->getRoles();

        require __DIR__ . '/../../views/cms/user/create.php';
    }
    public function edit()
    {
        $user = $this->userService->getById($_GET['userId']);
        $roles = $this->userService->getRoles();

        require __DIR__ . '/../../views/cms/user/edit.php';
    }

    public function store(): void
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
                    echo "<script>sessionStorage.setItem('error', 'Username already in use!'); window.location = '/admin/user/create';</script>";
                } else if ($this->userService->getByEmail($newUser->getEmail())) { //returns true if username or email exist in db
                    echo "<script>sessionStorage.setItem('error', 'Email already in use!'); window.location = '/user/user/create';</script>";
                } else if (!$this->userService->create($newUser)) {
                    echo "<script>sessionStorage.setItem('error', 'An error occurred while creating the user.'); window.location = '/user/user/create';</script>";
                } else {
                    echo "<script>sessionStorage.setItem('success', 'Created successfully!'); window.location = '/admin/user';</script>";
                }
                
            } catch (Exception $e) {
                echo "<script>sessionStorage.setItem('error', " . json_encode("An error occurred: " . $e->getMessage()) . ");</script>";

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


                if(isset($_POST['password']) && $_POST['password'] != ""){
   
                    $newUser->setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
                    $newUser->setVisiblePassword($_POST['password']);

                }

                $newUser->setEmail(htmlspecialchars(isset($_POST['email']) ? $_POST['email'] : ""));
                $newUser->setRole(htmlspecialchars(isset($_POST['role']) ? $_POST['role'] : 2)); //default customer

                

    
                
                 if ($this->userService->validateUser($newUser, $_POST['id'])) { //returns true if user.username and user.email do not exist in db excluding id
                    echo "<script>sessionStorage.setItem('error', 'Username or Email already in use!'); window.location = '/admin/user';</script>";
                } 
                else if (!$this->userService->update($newUser)) {
                    echo "<script>sessionStorage.setItem('error', 'Failed to update User.'); window.location = '/admin/user';</script>";
                } else {
                    echo "<script>sessionStorage.setItem('success', 'Updated successfully!'); window.location = '/admin/user';</script>";
                }
                
            } catch (Exception $e) {

                echo "<script>sessionStorage.setItem('error', " . json_encode("An error occurred: " . $e->getMessage()) . ");</script>";

            }
        }
    }

    public function delete()
    {
        require __DIR__ . '/../../views/cms/user/delete.php';
        $userId = $_GET['userId'];
        if ($this->userService->deleteById($userId)) {
            echo "<script>sessionStorage.setItem('success', 'User deleted successfully.');</script>";
        } else {
            echo "<script>sessionStorage.setItem('error', 'Failed to delete User.');</script>";
        }
    }

}
