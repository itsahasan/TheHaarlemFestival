<?php
require __DIR__ . '/../repositories/userrepository.php';
class UserService
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function getAll()
    {
        $repository = new UserRepository();
        return $repository->getAll();
    }

    public function getRoles()
    {
        $repository = new UserRepository();
        return $repository->getRoles();
    }

    public function getById($id)
    {
        $repository = new UserRepository();
        return $repository->getById($id);
    }

    public function getByUsername($username)
    {
        $repository = new UserRepository();
        return $repository->getByUsername($username);
    }

    public function getByEmail($email)
    {
        $repository = new UserRepository();
        return $repository->getByEmail($email);
    }

    public function deleteById($id)
    {
        $repository = new UserRepository();
        return $repository->deleteById($id);
    }

    public function create(User $user)
    {
        $repository = new UserRepository();
        return $repository->createUser($user);
    }

    public function update(User $user)
    {
        $repository = new UserRepository();
        return $repository->updateUser($user);
    }

    public function validateUser(User $user, $id)
    {
        return $this->userRepository->checkExistingUser($user, $id); //returns true if username or email exist in db
    }
}
