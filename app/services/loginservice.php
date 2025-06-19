<?php
// app/services/LoginService.php

require_once __DIR__ . '/../repositories/LoginRepository.php';

class LoginService
{
    private LoginRepository $loginRepository;

    public function __construct()
    {
        $this->loginRepository = new LoginRepository();
    }

    public function register(string $username, string $password, string $email): bool
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        return $this->loginRepository->register($username, $hashedPassword, $email);
    }

    public function verifyUser(string $username, string $password): ?User
    {
        $user = $this->loginRepository->getByUsername($username);
        if ($user && password_verify($password, $user->getPassword())) {
            return $user;
        }
        return null;
    }

    public function getByUsername(string $username): ?User
    {
        return $this->loginRepository->getByUsername($username);
    }

    public function getByEmail(string $email): ?User
    {
        return $this->loginRepository->getByEmail($email);
    }

    // ## МЕТОДЫ ДЛЯ СБРОСА ПАРОЛЯ, КОТОРЫЕ МЫ ВОЗВРАЩАЕМ ##

    public function createVerificationCode(int $code, int $userId): bool
    {
        return $this->loginRepository->createVerificationCode($code, $userId);
    }

    public function isValid(int $code): ?User
    {
        return $this->loginRepository->isValid($code);
    }

    public function updatePassword(int $userId, string $password): bool
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        return $this->loginRepository->updatePassword($userId, $hashedPassword);
    }

    public function deleteCode(int $userId): bool
    {
        return $this->loginRepository->deleteCode($userId);
    }

    public function getById(int $id): ?User
    {
        return $this->loginRepository->getById($id);
    }
}