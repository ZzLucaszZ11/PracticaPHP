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
    if($_SERVER["REQUEST METHOD"] == "POST"){
        $usuario = $_POST["usuario"];
        $contrasena = $_POST["contrasena"];

        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' ";
        $resultado = $_conexion -> query($sql);

        if($resultado -> num_rows === 0) {
            echo "El usuario no existe";
        } else {
            while($fila = $resultado -> fetch_assoc()) {
                $contrasena_cifrada = $fila["contrasena"];
            }
    
            $acceso_valido = password_verify($contrasena, $contrasena_cifrada);
    
            if($acceso_valido) {
                session_start();
                $_SESSION["usuario"] = $usuario;
                $_SESSION["loquesea"] = "loquesea";
                //SELECT rol FROM usuarios WHERE usuario = '$usuario';
                // $_SESSION["rol"] = ...
                header('location: principal.php');
                echo "HOLA " . $_SESSION["usuario"];
            else {
                echo "CONTRASEÑA MAL";
            }
        }

        
    }
    <div class="container">
        <h1>Iniciar sesión</h1>
        <form action="" method="post">
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input type="text" class="form-control" name="usuario">
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="contrasena">
            </div>
            <input class="form-control "type="submit" value="Iniciar sesion">
        </form>
    </div>
<script src></script> 
</body>
</html>