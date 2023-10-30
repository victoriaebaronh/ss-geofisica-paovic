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

<!DOCTYPE html>
<html>
<head>
    <title>Formulario enviado</title>
</head>
<body>
    <?php
    
    function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $area_solicitante = test_input($_POST["area_solicitante"]);
        $folio = test_input($_POST["folio"]);
        $responsable_area = test_input($_POST["responsable_area"]);
        $fecha_solicitud = test_input($_POST["fecha_solicitud"]);
        $nombre_usuario = test_input($_POST["nombre_usuario"]);
        $telefono = test_input($_POST["telefono"]);
        $correo_electronico = test_input($_POST["correo_electronico"]);
        $descripcion = test_input($_POST["descripcion"]);

        echo "<div class='container'>";
        echo "<h3>Tu infirmación fue enviada con éxito!:</h3>";
        echo "<p>Área Solicitante: $area_solicitante</p>";
        echo "<p>Folio: $folio</p>";
        echo "<p>Responsable del Área Solicitante: $responsable_area</p>";
        echo "<p>Fecha de Solicitud: $fecha_solicitud</p>";
        echo "<p>Nombre del Usuario: $nombre_usuario</p>";
        echo "<p>Teléfono: $telefono</p>";
        echo "<p>Correo Electrónico: $correo_electronico</p>";
        echo "<p>Descripción del Servicio: $descripcion</p>";
        echo "</div>";
        
    }
    ?>
</body>
</html>
