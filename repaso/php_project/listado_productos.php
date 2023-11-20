<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require './bootstrap.php' ?>
    <link rel="stylesheet" href="css/listado_productos.css">

    <title>Listado productos</title>
</head>
    <body>

    <?php
    session_start();

    //comprobar si ha iniciado sesion y si no pues le pondremos la sesion con valor a invitado y un boton de login y si ha iniciado le pondremos un boton de logout
    if (isset($_SESSION["usuario"])) {
        echo '<a href="./cerrar_sesion.php">Logout</a>';
        echo '<a href="./formulario_productos.php">Añadir producto</a>';
    } else {
        echo '<a href="./iniciar_sesion.php">Login</a>';
    }
    require './conexion.php';

    // Consulta para obtener los nombres de los productos y sus imágenes
    $sql = "SELECT * FROM productos";
    $result = $conn->query($sql);
    echo "<table class='table table-borderless'>";
    echo "<thead class='table-danger'>";
    echo "<tr>";
    echo "<th class='a' scope='col' >id</th>";
    echo "<th class='a' scope='col' >nombre</th>";
    echo "<th class='a' scope='col' >precio</th>";
    echo "<th class='a' scope='col' >descripcion</th>";
    echo "<th class='a' scope='col' >cantidad</th>";
    echo "<th class='a' scope='col' >imagen</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row["idProducto"] . '</td>';
            echo '<td>' . $row["nombreProducto"] . '</td>';
            echo '<td>' . $row["precio"] . '</td>';
            echo '<td>' . $row["descripcion"] . '</td>';
            echo '<td>' . $row["cantidad"] . '</td>';
            echo '<td><img src="' . $row["imagen"] . '" alt="' . $row["nombreProducto"] . '" width="100" height="100"></td>';
            echo '</tr>';
        }
    } else {
        echo "<li>No hay productos disponibles</li>";
    }

    $conn->close();



    ?>






</body>

</html>