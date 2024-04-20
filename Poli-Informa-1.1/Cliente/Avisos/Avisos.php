<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avisos</title>
</head>
<body>
    <?php include '../Partes/MenuUsuario.php'; ?>

    <div class="home">
        <div class="text">
        <?php 
            if(empty($_GET['codigo'])){
                // No se pasó ningún código en la URL
            } else {
                echo "Bienvenido " . $_GET['nombre']; // Mostrar el nombre de usuario
                echo "<br>";
                echo "Tu código es: " . $_GET['codigo']; // Mostrar el código de usuario
            }
        ?>
        </div>
    </div>
</body>
</html>