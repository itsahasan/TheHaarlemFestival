<?php

use PHPMailer\Mailer;

require __DIR__ . '/../utils/mailer.php';
require __DIR__ . '/../services/userservice.php';

class profilecontroller
{
    private $userService;
    private $mailer;

    function __construct()
    {
        $this->userService = new UserService();
        $this->mailer = new Mailer();
        session_start();
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
                    echo "<script>sessionStorage.setItem('error', 'Username or Email already in use!'); window.location = '/profile/view';</script>";
                } 
                else if (!$this->userService->update($newUser)) {
                    echo "<script>sessionStorage.setItem('error', 'Failed to update User.'); window.location = '/profile/view';</script>";
                } else {
                    echo "<script>sessionStorage.setItem('success', 'Updated successfully!'); window.location = '/profile/view';</script>";
                }
                
            } catch (Exception $e) {

                echo "<script>sessionStorage.setItem('error', " . json_encode("An error occurred: " . $e->getMessage()) . ");</script>";

            }
        }
    }


  
    public function view()
    {
        if (isset($_SESSION['userId'])) {
            $user = $this->userService->getById($_SESSION['userId']);
            require __DIR__ . '/../views/cms/user/profile.php';
        } else {
            echo "<script>sessionStorage.setItem('error', 'Please log in to access profile!'); window.location = '/page/festival';</script>";

        }
    }
}
