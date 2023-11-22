<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require './bootstrap.php' ?>
</head>

<body>
<?php
session_start();
require './conexion.php';
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $nombre = $_POST['nombre'];
    $precio = floatval($_POST['precio']);
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];

    if (empty($nombre) || strlen($nombre) > 40) {
        $error .= "Error: El nombre del producto debe tener entre 1 y 40 caracteres.<br>";
    }

    if ($precio <= 0 || $precio > 99999.99) {
        $error .= "Error: El precio debe ser un número mayor a 0 y como máximo 99999.99.<br>";
    }

    if (empty($descripcion) || strlen($descripcion) > 255) {
        $error .= "Error: La descripción del producto debe tener entre 1 y 255 caracteres.<br>";
    }

    if ($cantidad < 0 || $cantidad > 99999) {
        $error .= "Error: La cantidad debe ser un número entre 0 y 99999.<br>";
    }

    if (empty($_FILES["imagen"]["name"])) {
        $error .= "Error: Se requiere adjuntar una imagen.<br>";
    }

    if (empty($error)) {
        $nombre_fichero = $_FILES["imagen"]["name"];
        $ruta_temporal = $_FILES["imagen"]["tmp_name"];
        $formato = $_FILES["imagen"]["type"];
        $ruta_final = "../views/img/" . $nombre_fichero;

        move_uploaded_file($ruta_temporal, $ruta_final);

        $sql = "INSERT INTO Productos (nombreProducto, precio, descripcion, cantidad, imagen) VALUES ('$nombre', $precio, '$descripcion', $cantidad, '$ruta_final')";

        if ($conn->query($sql) === TRUE) {
            echo "Producto añadido con éxito";
        } else {
            echo "Error al añadir producto: " . $conn->error;
        }
    }
}

$conn->close();
    ?>

    <div class="hola">
        <a href="cerrar_sesion.php"><button>Cerrar Sesión</button></a>

        <h1>Formulario para crear un nuevo producto</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <label class="form-label">Nombre del producto:</label>
            <input class="form-control" type="text" name="nombre"><br><br>
            <label class="form-label">Precio:</label>
            <input class="form-control" name="precio"><br><br>
            <label class="form-label">Descripción:</label>
            <input class="form-control" type="text" name="descripcion"><br><br>
            <label class="form-label" for="">Cantidad</label>
            <input class="form-control" type="number" name="cantidad"><br><br>
            <label class="form-label">Imagen</label>
            <input class="form-control" type="file" name="imagen" accept=".jpg, .jpeg, .png" maxlength="5000000"><br><br>
            <input class="btn btn-primary mb-3" type="submit" value="Enviar">
        </form>
        <a href="listado_productos.php">
            <button type="button" class="btn btn-light">Ir a listado productos</button>
        </a>
        <?php
        if (!empty($error)) {
            echo "<div class='alert alert-danger' role='alert'>$error</div>";
        }
        ?>
    </div>

</body>

</html>
