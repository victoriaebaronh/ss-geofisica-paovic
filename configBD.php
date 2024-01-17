<?php

// Configuración de la base de datos
$config = array(
    'servername' => 'localhost',
    'username' => 'root',
    'password' => 'PaoVic',
    'database' => 'Solicitudes'
);

// Función para conectar a la base de datos
function conectarBD() {
    global $config;

    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['database']);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    return $conn;
}
?>
