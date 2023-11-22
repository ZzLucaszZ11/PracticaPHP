<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../views/registrarse.css">
    
    
</head>

<body>

<?php
session_start();
require './conexion.php';
$error_usuario = $error_contrasenia = $error_fecha = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $contrasenia = $_POST["contrasenia"];
    $fechaNacimiento = $_POST["nacimiento"];

    
    if (empty($usuario) || strlen($usuario) < 4 || strlen($usuario) > 12 || !preg_match('/^[a-zA-Z_]+$/', $usuario)) {
        $error_usuario = "El nombre de usuario no es válido (debe tener entre 4 y 12 caracteres y contener solo letras y guiones bajos).";
    }

    
    if (empty($contrasenia) || !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()\-_=+{};:,<.>ยง~])[A-Za-z\d!@#$%^&*()\-_=+{};:,<.>ยง~]{8,20}$/'
    , $contrasenia)) {
        $error_contrasenia = "La contraseña no es válida (debe tener al menos un carácter en minúscula, uno en mayúscula, un número, un carácter especial y tener una longitud de entre 8 y 20 caracteres).";
    }

    
    if (empty($fechaNacimiento)) {
        $error_fecha = "La fecha de nacimiento es obligatoria.";
    } else {
        $edad = date_diff(date_create($fechaNacimiento), date_create('today'))->y;
        if ($edad < 12 || $edad > 120) {
            $error_fecha = "Debes tener entre 12 y 120 años para registrarte.";
        }
    }

    
    if (empty($error_usuario) && empty($error_contrasenia) && empty($error_fecha)) {
        $contrasenia = password_hash($contrasenia, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (usuario, contrasena, fechaNacimiento) VALUES ('$usuario', '$contrasenia', '$fechaNacimiento')";
        $conn->query($sql);

        $idUsuario = $conn->insert_id;
        $sqlCesta = "INSERT INTO cestas (idCesta, usuario, precioTotal) VALUES ('$idUsuario', '$usuario', 0)";
        $conn->query($sqlCesta);

        header('location: iniciar_sesion.php');
    }
}
?>


<div class="wrapper">
    <form style="padding: 50px;" action="" method="post">
        <h1>Registro</h1>
        <?php if (!empty($error_usuario)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_usuario; ?>
            </div>
        <?php } ?>
        <div class="input-box">
            <label class="label_nombre">Usuario:</label>
            <input class="form-control" type="text" name="usuario">
            <br><br>
        </div>
        <?php if (!empty($error_contrasenia)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_contrasenia; ?>
            </div>
        <?php } ?>
        <div class="input-box">
            <label class="label_nombre">Contraseña:</label>
            <input class="form-control" type="password" name="contrasenia">
        </div>
        <?php if (!empty($error_fecha)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_fecha; ?>
            </div>
        <?php } ?>
        <div class="input-box">
            <label class="form-label">Fecha de nacimiento</label>
            <input class="form-control" type="date" name="nacimiento">
        </div>
        <div class="remember-forgot">
            <p>Si tienes cuenta inicia sesión <a href="iniciar_sesion.php">aquí</a></p>
        </div>
        <br>
        <input class="btn btn-primary mb-3 boton" type="submit" value="Registrarse">
    </form>
</div>

</body>

</html>