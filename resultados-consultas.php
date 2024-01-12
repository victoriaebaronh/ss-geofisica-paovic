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

        <div class="container" style="height: 10px;">
            <a href="#" style="font-size: 12px;">Volver</a>
        </div>

        <div class="container text-center" style="padding:2%;">
            <h3>Solicitudes:</h3>
        </div>

        <div class="selector-wrapper" style="width: 70%; margin: auto; text-align: center; ">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Folio</th>
                        <th scope="col">Área</th>
                        <th scope="col">Usuario</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'formularioSTecnica.php';
                   
                    $result = $conn->query($sql);

                   
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<th scope='row'><a href='#'>" . $row["folio"] . "</a></th>";
                            echo "<td>" . $row["area"] . "</td>";
                            echo "<td>" . $row["usuario"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No se encontraron resultados.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
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