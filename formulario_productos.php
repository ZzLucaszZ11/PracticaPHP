<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Productos</title>
    <? require 'conexion.php' ?>
</head>
<body>
    <h1>Formulario de Productos</h1>
    
    <form action="" method="post">
        <label for="nombreProducto">Nombre del Producto:</label>
        <input type="text" id="nombreProducto" name="nombreProducto" maxlength="40" required><br><br>

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" step="0.01" min="0" max="99999.99" required><br><br>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" maxlength="255" required></textarea><br><br>

        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" min="0" max="99999" required><br><br>

        <input type="submit" value="Registrar Producto">
    </form>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreProducto = $_POST["nombreProducto"];
    $precio = $_POST["precio"];
    $descripcion = $_POST["descripcion"];
    $cantidad = $_POST["cantidad"];

    // Validación de los datos (puedes agregar más validaciones si es necesario)
    if (strlen($nombreProducto) > 40) {
        die("Error: El nombre del producto debe tener como máximo 40 caracteres.");
    }

    if ($precio < 0 || $precio > 99999.99) {
        die("Error: El precio debe estar entre 0 y 99999.99.");
    }

    if (strlen($descripcion) > 255) {
        die("Error: La descripción debe tener como máximo 255 caracteres.");
    }

    if ($cantidad < 0 || $cantidad > 99999) {
        die("Error: La cantidad debe estar entre 0 y 99999.");
    }

    // Conectar a la base de datos y realizar la inserción
    $servername = "localhost";
    $username = "root";
    $password = "lmm12345";
    $dbname = "phpbasedatos";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    $sql = "INSERT INTO Productos (nombreProducto, precio, descripcion, cantidad) VALUES ('$nombreProducto', '$precio', '$descripcion', '$cantidad')";

    if ($conn->query($sql) === TRUE) {
        echo "Producto registrado correctamente.";
    } else {
        echo "Error al registrar producto: " . $conn->error;
    }

    $conn->close();
}
?>

</body>
</html>
