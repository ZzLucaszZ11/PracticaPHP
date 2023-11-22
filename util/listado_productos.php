<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require './bootstrap.php' ?>
    <link rel="stylesheet" href="../views/listado_productos.css">

    <title>Listado productos</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="cerrar_sesion.php">Cerrar sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php
        session_start();
        require './conexion.php';
        $usuario = $_SESSION["usuario"];
        echo "<h3>Bienvenid@: " . $usuario . "</h3>";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['idProducto']) && isset($_POST['cantidad'])) {
                $idProducto = $_POST['idProducto'];
                $cantidad = $_POST['cantidad'];
                $idCesta = 1; 
        
                
                $sqlCheckExistence = "SELECT * FROM ProductosCestas WHERE idProducto = '$idProducto' AND idCesta = '$idCesta'";
                $resultCheck = $conn->query($sqlCheckExistence);
        
                if ($resultCheck->num_rows > 0) {
                    
                    $sqlUpdateCantidad = "UPDATE ProductosCestas SET cantidad = cantidad + $cantidad WHERE idProducto = '$idProducto' AND idCesta = '$idCesta'";
                    if ($conn->query($sqlUpdateCantidad) === TRUE) {
                        echo "Cantidad actualizada en la cesta.<br>";
                    } else {
                        echo "Error al actualizar la cantidad en la cesta: " . $conn->error;
                    }
                } else {
                    
                    $sqlInsertCesta = "INSERT INTO ProductosCestas (idProducto, idCesta, cantidad) VALUES ('$idProducto', '$idCesta', '$cantidad')";
                    if ($conn->query($sqlInsertCesta) === TRUE) {
                        echo "Producto añadido a la cesta.<br>";
                    } else {
                        echo "Error al añadir el producto a la cesta: " . $conn->error;
                    }
                }

              
                $sqlUpdateCantidadProducto = "UPDATE productos SET cantidad = cantidad - $cantidad WHERE idProducto = '$idProducto'";
                $conn->query($sqlUpdateCantidadProducto);
            } else {
                echo "Error: No se enviaron datos correctos desde el formulario.";
            }
        }

        if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin') {
            
            echo "<a href='formulario_productos.php'><button class='boton_producto'>Añadir Producto</button></a>";
        }

        echo "<a href='cesta.php'><button class='boton_cesta'>Ir a la cesta</button></a>";

        $sql = "SELECT * FROM productos";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<div class='table-container'>";
            echo "<table class='table table-borderless'>";
            echo "<thead class='table-danger'>";
            echo "<tr>";
            echo "<th class='a' scope='col'>id</th>";
            echo "<th class='a' scope='col'>nombre</th>";
            echo "<th class='a' scope='col'>precio</th>";
            echo "<th class='a' scope='col'>descripcion</th>";
            echo "<th class='a' scope='col'>cantidad</th>";
            echo "<th class='a' scope='col'>imagen</th>";
            echo "<th class='a' scope='col'>Añadir Cesta</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td class="b">' . $row["idProducto"] . '</td>';
                echo '<td class="b">' . $row["nombreProducto"] . '</td>';
                echo '<td class="b">' . $row["precio"] . '</td>';
                echo '<td class="b">' . $row["descripcion"] . '</td>';
                echo '<td class="b">' . $row["cantidad"] . '</td>';
                echo '<td class="b"><img src="' . $row["imagen"] . '" alt="' . $row["nombreProducto"] . '" width="100" height="100"></td>';
                if ($row["cantidad"] > 0) {
                    $maxCantidad = min(5, $row["cantidad"]); 
        ?>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="idProducto" value="<?php echo $row["idProducto"] ?>">
                            <input type="number" name="cantidad" id="" min="1" max="<?php echo $maxCantidad; ?>" value="1">
                            <input type="submit" value="Añadir a la cesta">
                        </form>
                    </td>
        <?php
                } else {
                    echo '<td>Agotado</td>';
                }
                echo '</tr>';
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        }
        $conn->close();
        ?>
    </div>
</body>

</html>
