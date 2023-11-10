<?php
require "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $contrasenia = $_POST["contrasenia"];
    $fechaNacimiento = $_POST["nacimiento"];

    if (isset($usuario) && isset($contrasenia) && isset($fechaNacimiento)) {
        // Insertar el usuario en la tabla de usuarios
        $sqlUsuario = "INSERT INTO usuarios (usuario, contrasena, fechaNacimiento)
            VALUES ('$usuario', '$contrasenia', '$fechaNacimiento')";
        $conexion->query($sqlUsuario);

        // Obtener el ID del nuevo usuario insertado
        $usuarioId = $conexion->insert_id;

        // Insertar una cesta vacía para el nuevo usuario en la tabla de cestas
        $sqlCesta = "INSERT INTO Cestas (usuario, precioTotal) VALUES ('$usuarioId', 0.00)";
        $conexion->query($sqlCesta);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Tu código del encabezado (head) aquí -->
</head>

<body>
    <div class="mb-3">
        <h1>Formulario para crear un nuevo Usuario</h1>
        <form action="" method="post">
            <!-- Tu formulario aquí -->
        </form>
    </div>
</body>

</html>