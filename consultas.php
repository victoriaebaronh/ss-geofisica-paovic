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

if (isset($_POST['consultarBtn'])) {
    $opcion = $_POST['opciones'];

    // Seleccionar todas las solicitudes
    if ($opcion == '1') {
        $sql = "SELECT * FROM Solicitudes";
        $stmt = conectarBD()->prepare($sql);
    } elseif ($opcion == '2') {
        // Seleccionar solicitudes del año actual
        $sql = "SELECT * FROM Solicitudes WHERE YEAR(Fecha) = YEAR(CURDATE())";
        $stmt = conectarBD()->prepare($sql);
    } elseif ($opcion == '3') {
        // Seleccionar solicitudes del mes actual
        $sql = "SELECT * FROM Solicitudes WHERE MONTH(Fecha) = MONTH(CURDATE()) AND YEAR(Fecha) = YEAR(CURDATE())";
        $stmt = conectarBD()->prepare($sql);
    } elseif ($opcion == '4') {
        // Seleccionar solicitudes de hoy
        $sql = "SELECT * FROM Solicitudes WHERE DATE(Fecha) = CURDATE()";
        $stmt = conectarBD()->prepare($sql);
    } elseif ($opcion == '5') {
        // fechas elegidas manualmente
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Solicitudes - Secretaría Técnica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body style="min-height: 100vh; display: flex; flex-direction: column;">
    <div class="container-sm" style="flex: 1;">

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
            <h3>Consulta de solicitudes:</h3>
        </div>

        <form id="consultaForm" action="../resultados-consultas.php" method="post">
            <div class="selector-wrapper" style="width: 70%; margin: auto; text-align: center; ">
                <select id="opciones" class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option selected>Elige una opción</option>
                    <option value="1">Ver todo</option>
                    <option value="2">Año actual</option>
                    <option value="3">Mes actual</option>
                    <option value="4">Hoy</option>
                    <option value="5">Ingresar manualmente</option>
                </select>
                <br>

                <div class="elegir-fecha-wrapper" style="display: none;">
                    Este es el contenido de elegir-fecha-wrapper
                </div>

                <br>
                <button type="submit" name="consultarBtn" class="btn btn-primary"
                    style="width: 150px; margin: auto; font-size: 15px;">Consultar</button>
            </div>
        </form>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <script>
        document.getElementById('opciones').addEventListener('change', function () {
            var elegirFechaWrapper = document.querySelector('.elegir-fecha-wrapper');

            if (this.value === '5') {
                elegirFechaWrapper.style.display = 'block';
            } else {
                elegirFechaWrapper.style.display = 'none';
            }
        });
    </script>
</body>

<footer class="bg-light text-center text-lg-start" style="padding:5%; margin-top: 4%;">
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