<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <?php require "conexion.php" ?> 
    <?php require './bootstrap.php' ?>
</head>

<body>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
  
        $usuario = $_POST["usuario"];
        $contrasenia = $_POST["contrasenia"];
        $fechaNacimiento = $_POST["nacimiento"];
        

        if (
            isset($usuario) && isset($contrasenia)
            && isset($fechaNacimiento)
        ) {

            //introduce datos en la base de datos
            $sql = "INSERT INTO usuarios (usuario,contrasena, fechaNacimiento)
                VALUES ('$usuario', '$contrasenia', '$fechaNacimiento')";

            $conexion->query($sql);
        }
    }
    ?>
    <div class="mb-3">
    <h1>Formulario para crear un nuevo Usuario</h1>
    <form action="" method="post">
        <label class="form-label">Usuario:</label>
        <input class="form-control" type="text" name="usuario">
        <?php if (isset($err_usuario)) echo $err_usuario ?>
        <br><br>
        <label class="form-label">Contraseña</label>
        <input class="form-control" type="password" name="contrasenia">
        <br><br>
        <label class="form-label">Fecha de nacimiento</label>
        <input class="form-control" type="date" name="nacimiento"><br>
        <?php if (isset($err_fecha)) echo $err_fecha ?>
        <input class="btn btn-primary mb-3" type="submit" value="enviar">
    </form>
    </div>



</body>

</html>