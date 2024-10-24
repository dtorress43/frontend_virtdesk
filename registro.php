<?php
require 'vendor/autoload.php'; // Asegúrate de instalar el paquete MongoDB con Composer

use MongoDB\Client;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validar correo electrónico
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Correo electrónico no válido.');
    }

    // Hashear la contraseña
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Conectar a MongoDB
    $client = new Client("mongodb://127.0.0.1:27017");
    $collection = $client->virtdesk_db->usuarios;

    // Verificar si el usuario ya existe
    $existingUser = $collection->findOne(['email' => $email]);
    if ($existingUser) {
        die('El correo electrónico ya está registrado.');
    }

    // Insertar el nuevo usuario
    $result = $collection->insertOne([
        'email' => $email,
        'password' => $hashedPassword
    ]);

    if ($result->getInsertedCount() === 1) {
        header('Location: sesion_iniciada.html');
        exit();
    } else {
        die('Error al registrar el usuario.');
    }
}
?>
