<?php
// auth_service.php

// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del POST
$user = $_POST['user'];
$pass = $_POST['pass'];

// Preparar y ejecutar la consulta
$sql = "SELECT * FROM users WHERE username = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $user, $pass);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si el usuario existe y la contraseña es correcta
if ($result->num_rows > 0) {
    echo json_encode(["message" => "autenticación satisfactoria"]);
} else {
    echo json_encode(["message" => "error en la autenticación"]);
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
