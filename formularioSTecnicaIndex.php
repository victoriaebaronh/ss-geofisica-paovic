<?php
// include 'configDB.php';
function conectarBD()
{
    $servername = "localhost";
    $username = "root";
    $password = "PaoVic";
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulario - Secretaría Técnica</title>
    <script>
        // Función para obtener la fecha actual en el formato 'YYYY-MM-DD'
        function obtenerFechaActual() {
            const fecha = new Date();
            const year = fecha.getFullYear();
            const month = String(fecha.getMonth() + 1).padStart(2, '0');
            const day = String(fecha.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }
        // Función para establecer la fecha actual en el campo de entrada
        function establecerFechaActual() {
            document.getElementById('fecha_solicitud').value = fechaActual;
        }
        // Ejecutar la función al cargar la página
        const fechaActual = obtenerFechaActual();
        window.onload = establecerFechaActual;
        // Función para validar el formato del correo electrónico
        function validarCorreoElectronico(correo) {
            // Expresión regular para validar el formato del correo electrónico
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(correo);
        }
        // Event listener para el envío del formulario
        document.getElementById('formularioSTecnica').addEventListener('submit', function (event) {
            var areaSolicitante = document.getElementById('area_solicitante').value;
            var responsableArea = document.getElementById('responsable_area').value;
            var fechaSolicitud = document.getElementById('fecha_solicitud').value;
            var nombreUsuario = document.getElementById('nombre_usuario').value;
            var telefono = document.getElementById('telefono').value;
            var correoElectronicoInput = document.getElementById('correo_electronico');
            var correoElectronicoValue = correoElectronicoInput.value;
            var descripcion = document.getElementById('descripcion').value;

            if (
                areaSolicitante === '' ||
                responsableArea === '' ||
                fechaSolicitud === '' ||
                nombreUsuario === '' ||
                telefono === '' ||
                correoElectronico === '' ||
                descripcion === ''
            ) {
                // Mostrar un mensaje de error
                alert('Todos los campos obligatorios deben estar llenos.');
                event.preventDefault(); // Evitar que se envíe el formulario si la validación falla
                return;
            }
            // Validar el formato del correo electrónico
            if (!validarCorreoElectronico(correoElectronicoValue)) {
                alert('Por favor, ingrese un correo electrónico válido.');
                event.preventDefault(); // Evitar que se envíe el formulario si la validación falla
            }
        });
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container-sm">
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <img src="assets/geofisica.png" alt="Logo" width="20%">
                    </a>
                    <div class="mx-auto d-flex align-items-center">
                        <a class="navbar-brand" href="#">Instituto de Geofísica</a>
                    </div>
                </div>
            </nav>
        </div>

        <div style="background-color: rgb(0,61,121); height: 5pt;"><br></div>
        <div style="background-color: rgb(213,159,28); height: 5pt;"><br></div>

        <div class="container text-center" style="padding:2%;">
            <h3>Solicitud única de servicios</h3>
        </div>

        <form id="formularioSTecnica" action="/formularioSTecnica.php" method="post" class="row g-3">
            <div class="col-md-8">
                <label for="area_solicitante" class="form-label">Área solicitante</label>
                <input type="text" class="form-control" id="area_solicitante" name="area_solicitante" required>
            </div>
            <div class="col-4">
                <label for="folio" class="form-label">Folio</label>
                <input type="text" class="form-control" id="folio" name="folio"
                    value="<?php echo date('Y') . '-' . $new_folio; ?>" readonly>
            </div>
            <div class="col-md-8">
                <label for="responsable_area" class="form-label">Responsable del área solicitante</label>
                <input type="text" class="form-control" id="responsable_area" name="responsable_area" required>
            </div>
            <div class="col-4">
                <label for="fecha_solicitud" class="form-label">Fecha de solicitud</label>
                <input type="text" class="form-control" id="fecha_solicitud" name="fecha_solicitud" readonly>
            </div>
            <div class="col-md-8">
                <label for="nombre_usuario" class="form-label">Nombre del usuario</label>
                <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required>
            </div>
            <div class="col-4">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" required>
            </div>
            <div class="col-12">
                <label for="correo_electronico" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción del Servicio: </label>
                <textarea class="form-control" id="descripcion" rows="3" name="descripcion"
                    placeholder="Especificar claramente fecha y hora del servicio requerido"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

<footer class="bg-light text-center text-lg-start" style="padding:5%; margin-top: 4%">
    <div class="container-sm row text-center" style="margin: auto;">
        <div class="col-sm-11 text-center" style="background-color: rgb(248,248,248);">
            <p style="font-size:xx-small;">Hecho en México. Universidad Nacional Autónoma de México (UNAM), todos los
                derechos reservados 2022.
                Esta página puede ser reproducida con fines no lucrativos, siempre y cuando no se mutile, se cite la
                fuente completa y su dirección electrónica. De otra forma requiere permiso previo por escrito de la
                institución. Instituto de Geofísica, UNAM. Circuito de la Investigación Científica s/n, Ciudad
                Univeritaria,
                Delegación Coyoacán, C.P. 04510, Ciudad de México.
                Sitio web administrado por el Ing. Daniel Rodríguez Osorio, danielro522@comunidad.unam.unam.mx</p>
        </div>
        <div class="col text-left">
            <img src="assets/unam-escudo-azul copia.png" class="img-fluid" alt="UNAM" style="width: 50px;">
        </div>
    </div>
</footer>

</html>