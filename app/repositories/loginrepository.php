<?php
// app/repositories/LoginRepository.php

require_once __DIR__ . '/../models/User.php';

class LoginRepository
{
    private \PDO $connection;

    public function __construct()
    {
        $configPath = __DIR__ . '/../config/dbconfig.php';
        if (!file_exists($configPath)) { throw new \RuntimeException("Missing config file"); }
        require $configPath;

        $dsn = sprintf('%s:host=%s;dbname=%s;charset=utf8mb4', $type, $servername, $database);
        try {
            $this->connection = new \PDO($dsn, $username, $password, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
        } catch (\PDOException $e) {
            error_log("DB connection failed: " . $e->getMessage());
            throw $e;
        }
    }

    public function getByUsername(string $username): ?User
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM user WHERE username = :username');
            $stmt->bindValue(':username', $username);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, User::class);
            $user = $stmt->fetch();
            return $user ?: null;
        } catch (PDOException $e) {
            error_log("getByUsername error: " . $e->getMessage());
            return null;
        }
    }

    public function register(string $username, string $hashedPassword, string $email): bool
    {
        try {
            $stmt = $this->connection->prepare('INSERT INTO user (username, password, roleId, email) VALUES (:username, :password, :roleId, :email)');
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':password', $hashedPassword);
            $stmt->bindValue(':roleId', 2);
            $stmt->bindValue(':email', $email);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Register error: " . $e->getMessage());
            return false;
        }
    }

    // ## МЕТОДЫ ДЛЯ СБРОСА ПАРОЛЯ, КОТОРЫЕ МЫ ВОЗВРАЩАЕМ ##

    public function createVerificationCode(int $code, int $userId): bool
    {
        try {
            $stmt = $this->connection->prepare('INSERT INTO verification_code (code, userId) VALUES (:code, :userId)');
            $stmt->bindValue(':code', $code, \PDO::PARAM_INT);
            $stmt->bindValue(':userId', $userId, \PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("createVerificationCode error: " . $e->getMessage());
            return false;
        }
    }

    public function isValid(int $code): ?User
    {
        try {
            $stmt = $this->connection->prepare('SELECT userId FROM verification_code WHERE code = :code AND timestamp >= DATE_SUB(NOW(), INTERVAL 10 MINUTE)');
            $stmt->bindValue(':code', $code, \PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch();
            if (!$row) { return null; }

            $userRepo = new LoginRepository(); // Create a new instance to call getById
            return $userRepo->getById((int)$row['userId']);
        } catch (PDOException $e) {
            error_log("isValid error: " . $e->getMessage());
            return null;
        }
    }

    public function updatePassword(int $userId, string $hashedPassword): bool
    {
        try {
            $stmt = $this->connection->prepare('UPDATE user SET password = :password WHERE id = :userId');
            $stmt->bindValue(':userId', $userId, \PDO::PARAM_INT);
            $stmt->bindValue(':password', $hashedPassword);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("updatePassword error: " . $e->getMessage());
            return false;
        }
    }

    public function deleteCode(int $userId): bool
    {
        try {
            $stmt = $this->connection->prepare('DELETE FROM verification_code WHERE userId = :userId');
            $stmt->bindValue(':userId', $userId, \PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("deleteCode error: " . $e->getMessage());
            return false;
        }
    }

    public function getById(int $id): ?User
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM user WHERE id = :id');
            $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, User::class);
            return $stmt->fetch() ?: null;
        } catch (PDOException $e) {
            error_log("getById error: " . $e->getMessage());
            return null;
        }
    }
}