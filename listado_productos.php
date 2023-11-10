<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
    <?php
        $sql = "SELECT * FROM Productos";
        $resultado= $conexion -> query($sql);

        while($fila = $resultado -> fetch_assoc()){
            echo "<tr>"
            echo "<td>" . $fila["nombreProducto"]"</td>"
            echo "<td>" . $fila["precio"]"</td>"
            echo "<td>" . $fila["descripcion"]"</td>"
            echo "<td>" . $fila["Cantidad"]"</td>"
            echo "<td>" . $fila["Imagen"]"</td>"
            <td>
                <img width="50" height="70" src="<?php echo $fila["imagen"]?>">
            </td>
            <?php
            echo "</tr>"
        }
    ?>
    </tbody>
    </table>
</body>
</html>