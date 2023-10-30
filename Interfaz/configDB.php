<?php
$servername = "localhost"; // Reemplaza con la dirección IP o nombre del servidor remoto
$username = "root";
$password = "Paolataemylove25";
$database = "Solicitudes";


// Crear una conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} else {
    echo "Conexión exitosa a la base de datos.";
    // Aquí puedes comenzar a ejecutar consultas y trabajar con la base de datos.
}
$conn->close();

// Resto de tu código para ejecutar consultas
?>
