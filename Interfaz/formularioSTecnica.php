<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulario enviado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        /* Estilos CSS adicionales si es necesario */
    </style>
</head>
<body>
    <div class="container-sm">
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <img src="geofisica.png" alt="Logo" width="20%">
                    </a>
                    <div class="mx-auto d-flex align-items-center">
                        <a class="navbar-brand" href="#">Instituto de Geofísica</a>
                    </div>
                </div>
            </nav>
        </div>

        <div style="background-color: rgb(0,61,121); height: 5pt;"></div>
        <div style="background-color: rgb(213,159,28); height: 5pt;"></div>

        <?php
        // Definir una función para validar y limpiar los datos del formulario
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        // Verificar si el formulario ha sido enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Procesar y guardar datos en la base de datos (conexión a la base de datos)
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

            // Limpiar y obtener los datos del formulario
            $area_solicitante = test_input($_POST["area_solicitante"]);
            $responsable_area = test_input($_POST["responsable_area"]);
            $folio = test_input($_POST["folio"]);
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

        <!-- Contenido del formulario -->
        <div class="container">
            <?php if (isset($folioGenerado)) : ?>
                <h3>Tu información fue enviada con éxito:</h3>
                <p><strong>Área Solicitante:</strong> <?php echo $area_solicitante; ?></p>
                <p><strong>Folio:</strong> <?php echo $folioGenerado; ?></p>
                <p><strong>Responsable del Área Solicitante:</strong> <?php echo $responsable_area; ?></p>
                <p><strong>Fecha de Solicitud:</strong> <?php echo $fecha_solicitud; ?></p>
                <p><strong>Nombre del Usuario:</strong> <?php echo $nombre_usuario; ?></p>
                <p><strong>Teléfono:</strong> <?php echo $telefono; ?></p>
                <p><strong>Correo Electrónico:</strong> <?php echo $correo_electronico; ?></p>
                <p><strong>Descripción del Servicio:</strong> <?php echo $descripcion; ?></p>
            <?php endif; ?>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <!-- Pie de página -->
    <footer class="text-center text-lg-start">
        <div class="container-sm row">
            <div class="col-sm-11 text-center" style="background-color: #f8f9fa;">
                <p style="font-size: xx-small;">Hecho en México. Universidad Nacional Autónoma de México (UNAM), todos los
                    derechos reservados 2022.
                    Esta página puede ser reproducida con fines no lucrativos, siempre y cuando no se mutile, se cite la
                    fuente completa y su dirección electrónica. De otra forma requiere permiso previo por escrito de la
                    institución. Instituto de Geofísica, UNAM. Circuito de la Investigación Científica s/n, Ciudad
                    Universitaria,
                    Delegación Coyoacán, C.P. 04510, Ciudad de México.
                    Sitio web administrado por el Ing. Daniel Rodríguez Osorio, danielro522@comunidad.unam.unam.mx
                </
