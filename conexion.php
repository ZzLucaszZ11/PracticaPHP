<?php
    $_servidor = 'localhost';
    $_usuario = 'root';
    $_contrasena = 'lmm12345';
    $_base_de_datos = 'phpbasedatos';

    $conexion =new Mysqli($_servidor,
                          $_usuario,
                          $_contrasena,
                          $_base_de_datos)
        or die("Error de conexión");
?>