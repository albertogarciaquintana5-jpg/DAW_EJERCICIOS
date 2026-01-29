<?php
// app/controllers/UserController.php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../models/User.php";

class UserController {
    private $userModel;

    public function __construct() {
        $pdo = getPDO();
        $this->userModel = new User($pdo);
    }

    public function index() {
        $users = $this->userModel->all();
        include __DIR__ . "/../views/users/index.php";
    }

    public function create() {
        include __DIR__ . "/../views/users/create.php";
    }

    public function store() {
        $data = [
            'nombre' => $_POST['nombre'] ?? '',
            'apellido' => $_POST['apellido'] ?? '',
            'email' => $_POST['email'] ?? '',
            'telefono' => $_POST['telefono'] ?? '',
            'fecha' => $_POST['fecha'] ?? '',
            'contraseña' => $_POST['contraseña'] ?? ''
        ];

        $errors = [];

        // Validaciones básicas
        if (empty($data['nombre'])) $errors[] = 'El nombre es obligatorio';
        if (empty($data['email'])) $errors[] = 'El email es obligatorio';
        if ($this->userModel->existsEmail($data['email'])) $errors[] = 'El email ya está registrado';
        if (!empty($data['telefono']) && $this->userModel->existsTelefono($data['telefono'])) $errors[] = 'El teléfono ya está registrado';
        if (empty($data['contraseña'])) $errors[] = 'La contraseña es obligatoria';

        if (count($errors) === 0) {
            $this->userModel->create($data);
            header('Location: index.php?action=index&msg=created');
            exit;
        } else {
            $errors = $errors; // pasar a la vista
            include __DIR__ . "/../views/users/create.php";
        }
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) header('Location: index.php?action=index');
        $user = $this->userModel->find($id);
        include __DIR__ . "/../views/users/edit.php";
    }

    public function update() {
        $id = $_POST['id'] ?? null;
        if (!$id) header('Location: index.php?action=index');

        $data = [
            'nombre' => $_POST['nombre'] ?? '',
            'apellido' => $_POST['apellido'] ?? '',
            'email' => $_POST['email'] ?? '',
            'telefono' => $_POST['telefono'] ?? '',
            'fecha' => $_POST['fecha'] ?? '',
            'contraseña' => $_POST['contraseña'] ?? ''
        ];

        $errors = [];
        if (empty($data['nombre'])) $errors[] = 'El nombre es obligatorio';
        if (empty($data['email'])) $errors[] = 'El email es obligatorio';
        if ($this->userModel->existsEmail($data['email'], $id)) $errors[] = 'El email ya está registrado por otro usuario';
        if (!empty($data['telefono']) && $this->userModel->existsTelefono($data['telefono'], $id)) $errors[] = 'El teléfono ya está registrado por otro usuario';

        if (count($errors) === 0) {
            $this->userModel->update($id, $data);
            header('Location: index.php?action=index&msg=updated');
            exit;
        } else {
            $user = array_merge($this->userModel->find($id) ?? [], $data);
            include __DIR__ . "/../views/users/edit.php";
        }
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->userModel->delete($id);
        }
        header('Location: index.php?action=index&msg=deleted');
        exit;
    }
}
