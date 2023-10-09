<!DOCTYPE html>
<html>
<head>
    <title>Resultado del Formulario</title>
</head>
<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST["nombre"];
        $correo = $_POST["correo"];
        $licenciatura = $_POST["licenciatura"];
        
        echo "Nombre Completo: " . $nombre . "<br>";
        echo "Correo: " . $correo . "<br>";
        echo "Licenciatura: " . $licenciatura . "<br>";
    }
    ?>
</body>
</html>