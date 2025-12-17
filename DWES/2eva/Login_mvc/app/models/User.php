<?php
/**
 * Modelo `User` que encapsula operaciones de usuario usando PDO.
 * Métodos principales:
 * - findByEmail($email): devuelve el usuario (array) o null
 * - create($email, $password, $name): crea un usuario y devuelve su id
 * - verifyPassword($email, $password): verifica credenciales
 * - findById($id): devuelve usuario por id
 */

class User
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->pdo->prepare('SELECT id, email, password_hash, nombre, rol FROM users WHERE email = :email LIMIT 1');
        $stmt->execute([':email' => $email]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT id, email, nombre, rol FROM users WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(string $email, string $password, string $nombre): int
    {
        // Validaciones básicas
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Email inválido');
        }
        if (strlen($password) < 6) {
            throw new InvalidArgumentException('La contraseña debe tener al menos 6 caracteres');
        }

        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->pdo->prepare('INSERT INTO users (email, password_hash, nombre, rol, created_at) VALUES (:email, :hash, :nombre, :rol, NOW())');
        $stmt->execute([
            ':email' => $email,
            ':hash' => $password_hash,
            ':nombre' => $nombre,
            ':rol' => 'user',
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function verifyPassword(string $email, string $password): bool
    {
        $user = $this->findByEmail($email);
        if (!$user) return false;
        return password_verify($password, $user['password_hash']);
    }
}
