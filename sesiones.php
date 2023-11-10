<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <? require 'CONEXION.php' ?>
</head>
<body>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $usuario = $_POST["usuario"];
        $contrasena = $_POST["contrasena"];

        $contrasena_cifrada = password_hash($contrasena, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuario VALUES ('$usuario' , '$contrasena_cifrada')";
        $conexion -> query($sql);
    }
    <div class="container">
        <h1>Registrarse</h1>

        <form action="" method="post">
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input class="form-control" type="text" name="usuario">
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input class="form-controll" type="password" name="contrasena">
            </div>
            <input class="btn btn-primary" type="button" value="Registrarse">
        </form>
    </div>
</body>
</html>