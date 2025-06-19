<?php
// app/models/User.php
declare(strict_types=1);

class User
{
    private int $id;
    private string $username;
    private string $password; // This property should store the HASH from the DB
    private int $roleId;
    private string $email;
    private string $created_at;

    // --- Getters ---

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRoleId(): int
    {
        return $this->roleId;
    }

    // Этот метод нужен контроллеру, но в базе у тебя только roleId
    public function getRole(): int
    {
        return $this->getRoleId();
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    // --- Setters ---

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    /**
     * This setter simply stores the value. It does NOT hash it.
     * Hashing is done only once in the controller before saving.
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function setRoleId(int $roleId): self
    {
        $this->roleId = $roleId;
        return $this;
    }

    public function setRole(int $roleId): self
    {
        return $this->setRoleId($roleId);
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function setCreationDate(string $created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }
}