<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/user.php';
class LoginRepository extends Repository
{
    public function register($username, $password, $email)
    {
        try {
            // Insert new user
            $query = 'INSERT INTO user (username, password, roleId, email, created_at) VALUES (:username, :password, :roleId, :email, NOW())';
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':password', $password);
            $stmt->bindValue(':roleId', 2); //default user is customer
            $stmt->bindValue(':email', $email);
            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            print_r($e);
        }
        return false;
    }

    public function getByUsername($username)
    {
        $stmt = $this->connection->prepare('SELECT * FROM user WHERE username = :username');
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        $user = new User();
        $user->setId($row['id']);
        $user->setUsername($row['username']);
        $user->setPassword($row['password']);
        $user->setEmail($row['email']);
        $user->setRole($row['roleId']);
        $user->setCreationDate($row['created_at']);

        return $user;
    }
    public function getByEmail($email)
    {
        $stmt = $this->connection->prepare('SELECT * FROM user WHERE email = :email');
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        $user = new User();
        $user->setId($row['id']);
        $user->setUsername($row['username']);
        $user->setPassword($row['password']);
        $user->setEmail($row['email']);
        $user->setRole($row['roleId']);
        $user->setCreationDate($row['created_at']);

        return $user;
    }

    public function getById($id)
    {
        $stmt = $this->connection->prepare('SELECT * FROM user WHERE id = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        $user = new User();
        $user->setId($row['id']);
        $user->setUsername($row['username']);
        $user->setPassword($row['password']);
        $user->setEmail($row['email']);
        $user->setRole($row['roleId']);
        $user->setCreationDate($row['created_at']);

        return $user;
    }

    public function createVerificationCode($code, $userId)
    {
        try {
            $query = 'INSERT INTO verification_code (code, userId) VALUES (:code, :userId)';
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(':code', $code);
            $stmt->bindValue(':userId', $userId);
            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            print_r($e);
        }
        return false;
    }

    public function isValid($code)
    {
        try {
            $query = 'SELECT userId
            FROM verification_code
            WHERE code = :code
              AND timestamp >= DATE_SUB(NOW(), INTERVAL 10 MINUTE);            
            ';
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(':code', $code);
            $stmt->execute();
            $row = $stmt->fetch();

            if (!$row) {
                return null;
            }
            $userId = $row['userId'];
            return $this->getById($userId);
        } catch (PDOException $e) {
            print_r($e);
        }
    }

    public function updatePassword($userId, $password)
    {
        try {
            $query = 'UPDATE user
            SET password = :password
            WHERE id = :userId';
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(':userId', $userId);
            $stmt->bindValue(':password', $password);
            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            print_r($e);
        }
        return false;
    }
}
