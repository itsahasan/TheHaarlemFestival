<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/user.php';

class UserRepository extends Repository
{
    function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM user");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            $users = $stmt->fetchAll();

            return $users;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getRoles()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM roles");
            $stmt->execute();
            $roles = $stmt->fetchAll();

            return $roles;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getByUsername($username)
    {
        $stmt = $this->connection->prepare('SELECT * FROM user WHERE username = :username');
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        $row = $stmt->fetch();
        if ($row != null) {
            return true;
        }
        return false;
    }
    public function getByEmail($email)
    {
        $stmt = $this->connection->prepare('SELECT * FROM user WHERE email = :email');
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch();

        if ($row != null) {
            return true;
        }

        return false;
    }

    public function getById($id)
    {
        $stmt = $this->connection->prepare('SELECT user.*, roles.name AS roleName
        FROM user
        JOIN roles ON user.roleId = roles.id
        WHERE user.id = :id');

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
        $user->setRoleName($row['roleName']);
        $user->setCreationDate($row['created_at']);

        return $user;
    }

    public function checkExistingUser(User $user, $id)
    {
        $query = "SELECT COUNT(*) FROM user WHERE (username = :username OR email = :email) AND id != :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':username', $user->getUsername());
        $stmt->bindParam(':email', $user->getEmail());
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    public function createUser(User $user)
    {
        try {
            // Insert new user
            $query = "INSERT INTO user (username, password, roleId, email, created_at) VALUES (:username, :password, :roleId, :email, CURRENT_TIMESTAMP)";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(':username', $user->getUsername());
            $stmt->bindValue(':password', $user->getPassword());
            $stmt->bindValue(':roleId', $user->getRole());
            $stmt->bindValue(':email', $user->getEmail());
            $stmt->execute();
            if ($stmt) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            print_r($e);
        }
    }

    public function updateUser(User $user)
    {
        try {
            $query = "UPDATE user SET roleId = :role" . (!empty($user->getUsername()) ? ", username = :username " : "") . (!empty($user->getPassword()) ? ", password = :password " : "") . (!empty($user->getEmail()) ? ", email = :email " : "") . "WHERE id = :id ";
            $stmt = $this->connection->prepare($query);
            if (!empty($user->getUsername())) {
                $stmt->bindParam(':username', $user->getUsername());
            }
            if (!empty($user->getPassword())) {
                $hashedPass = password_hash($user->getPassword(), PASSWORD_DEFAULT);
                $stmt->bindParam(':password', $hashedPass);
            }
            if (!empty($user->getEmail())) {
                $stmt->bindParam(':email', $user->getEmail());
            }
            $stmt->bindValue(':role', $user->getRole()); //default user is customer
            $stmt->bindValue(':id', $user->getId());
        } catch (PDOException $e) {
            print_r($e);
        }
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function deleteById($id)
    {
        $query = 'DELETE FROM user WHERE id = :id';

        try {
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            if ($stmt) {
                return true;
            }
        } catch (PDOException $e) {
            echo ($e);
        }
    }
}
