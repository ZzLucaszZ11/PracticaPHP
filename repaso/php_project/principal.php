<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    session_start();

    if(isset($_SESSION["usuario"])) {
        $usuario = $_SESSION["usuario"];
    } else {
        //header('location: iniciar_sesion.php'); # Si queremos que nos redirija al login
        $_SESSION["usuario"] = "invitado";
        $usuario = $_SESSION["usuario"];
    }
    $usuario = $_SESSION["usuario"];
    ?>
    <div class="container">
        <h1>Esta es la página principal</h1>
        <h2>Bienvenid@ <?php echo $usuario ?></h2>
    </div>
</body>
</html>