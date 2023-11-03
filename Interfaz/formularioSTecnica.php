<!DOCTYPE html>
<html>
<head>
    <title>Formulario enviado</title>
</head>
<body>

    <?php

    // Definir una función para validar y limpiar los datos del formulario
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Función para conectar a la base de datos
    function conectarBD() {
        $servername = "localhost";
        $username = "root";
        $password = "Paolataemylove25";
        $database = "Solicitudes";

        // Crear una conexión a la base de datos
        $conn = new mysqli($servername, $username, $password, $database);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
        return $conn;
    }

    // Conectar a la base de datos para obtener el último folio
    $conn = conectarBD();
    $sql_ultimo_folio = "SELECT MAX(folio) AS max_folio FROM Solicitudes";
    $result_ultimo_folio = $conn->query($sql_ultimo_folio);

    if ($result_ultimo_folio) {
        $row = $result_ultimo_folio->fetch_assoc();
        $ultimo_folio = $row['max_folio'];
        // Incrementa el último folio en 1 para el nuevo registro
        $new_folio = $ultimo_folio + 1;
    } else {
        $new_folio = 1; // Si no hay registros en la base de datos, comienza en 1
    }
    // Cerrar la conexión a la base de datos
    $conn->close();

    
    // Verificar si el formulario ha sido enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // conectar a la base de datos
        $conn = conectarBD();

        // Limpiar y obtener los datos del formulario
        $area_solicitante = test_input($_POST["area_solicitante"]);
        $folio = test_input($_POST["folio"]);
        $responsable_area = test_input($_POST["responsable_area"]);
        $fecha_solicitud = test_input($_POST["fecha_solicitud"]);
        $nombre_usuario = test_input($_POST["nombre_usuario"]);
        $telefono = test_input($_POST["telefono"]);
        $correo_electronico = test_input($_POST["correo_electronico"]);
        $descripcion = test_input($_POST["descripcion"]);

        // Realizar la consulta SQL para insertar datos en la base de datos
        $sql = "INSERT INTO Solicitudes (Area_del_Solicitante, Nombre_del_Responsable, Telefono, Fecha, Correo_Electronico, Descripcion_del_Servicio, Nombre_del_Usuario) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        // Preparar la consulta
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Vincular los parámetros con los valores del formulario
            $stmt->bind_param("sssssss", $area_solicitante, $responsable_area, $telefono, $fecha_solicitud, $correo_electronico, $descripcion, $nombre_usuario);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                // Obtener el valor del folio generado por la base de datos
                $folioGenerado = $conn->insert_id;
                
                // Actualizar el campo oculto en el formulario
                echo "<script>document.getElementById('folio').value = '$folioGenerado';</script>";
                echo "<div class='container'>";
                echo "<h3>Tu información fue enviada con éxito:</h3>";
                echo "<p>Área Solicitante: $area_solicitante</p>";
                echo "<p>Folio: $folioGenerado</p>"; // Mostrar el folio generado
                echo "<p>Responsable del Área Solicitante: $responsable_area</p>";
                echo "<p>Fecha de Solicitud: $fecha_solicitud</p>";
                echo "<p>Nombre del Usuario: $nombre_usuario</p>";
                echo "<p>Teléfono: $telefono</p>";
                echo "<p>Correo Electrónico: $correo_electronico</p>";
                echo "<p>Descripción del Servicio: $descripcion</p>";
                echo "</div>";
            } else {
                echo "Error al insertar datos en la base de datos: " . $stmt->error;
            }

            // Cerrar la consulta preparada
            $stmt->close();
        } else {
            echo "Error al preparar la consulta: " . $conn->error;
        }

        // Cerrar la conexión a la base de datos
        $conn->close();
    }
    ?>
</body>
</html>
