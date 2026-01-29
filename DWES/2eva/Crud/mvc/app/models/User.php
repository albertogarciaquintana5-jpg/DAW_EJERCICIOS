<?php
// app/models/User.php
// Modelo simple para tabla `usuarios`

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function all() {
        $stmt = $this->pdo->query("SELECT id, nombre, apellido, fecha, telefono, email FROM usuarios ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    public function count() {
        $stmt = $this->pdo->query("SELECT COUNT(*) AS c FROM usuarios");
        $row = $stmt->fetch();
        return (int)($row['c'] ?? 0);
    }

    public function findByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function find($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        // password debe estar en $data['contraseña'] y será hasheada aquí
        $hash = password_hash($data['contraseña'], PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (nombre, contraseña, apellido, fecha, telefono, email) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['nombre'],
            $hash,
            $data['apellido'],
            $data['fecha'],
            $data['telefono'],
            $data['email']
        ]);
    }

    public function update($id, $data) {
        // Si viene contraseña no vacía la actualizamos (hasheada), sino mantenemos la existente
        if (!empty($data['contraseña'])) {
            $hash = password_hash($data['contraseña'], PASSWORD_DEFAULT);
            $stmt = $this->pdo->prepare("UPDATE usuarios SET nombre=?, apellido=?, fecha=?, telefono=?, email=?, contraseña=? WHERE id=?");
            return $stmt->execute([
                $data['nombre'],
                $data['apellido'],
                $data['fecha'],
                $data['telefono'],
                $data['email'],
                $hash,
                $id
            ]);
        } else {
            $stmt = $this->pdo->prepare("UPDATE usuarios SET nombre=?, apellido=?, fecha=?, telefono=?, email=? WHERE id=?");
            return $stmt->execute([
                $data['nombre'],
                $data['apellido'],
                $data['fecha'],
                $data['telefono'],
                $data['email'],
                $id
            ]);
        }
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM usuarios WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Validaciones simples: existen email o telefono en otro registro
    public function existsEmail($email, $excludeId = null) {
        if ($excludeId) {
            $stmt = $this->pdo->prepare("SELECT id FROM usuarios WHERE email = ? AND id != ?");
            $stmt->execute([$email, $excludeId]);
        } else {
            $stmt = $this->pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
            $stmt->execute([$email]);
        }
        return $stmt->fetch() ? true : false;
    }

    public function existsTelefono($telefono, $excludeId = null) {
        if (empty($telefono)) return false;
        if ($excludeId) {
            $stmt = $this->pdo->prepare("SELECT id FROM usuarios WHERE telefono = ? AND id != ?");
            $stmt->execute([$telefono, $excludeId]);
        } else {
            $stmt = $this->pdo->prepare("SELECT id FROM usuarios WHERE telefono = ?");
            $stmt->execute([$telefono]);
        }
        return $stmt->fetch() ? true : false;
    }
}
