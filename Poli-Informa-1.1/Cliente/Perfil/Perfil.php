<?php
    include('../../Conexion/conexion.php');
    $db = new Database();
    $conexion = $db->connect();
    session_start();
?>
<?php include '../LoginU/inicio.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Perfil.css">
    <title>Mi perfil</title>
</head>
<body>
    <?php include '../Partes/MenuUsuario.php'; ?>
    <div class="contenedor">
        <?php
            // Obtener el código de usuario de la sesión
            $codeAlu = $_SESSION['CodeAlu'];
            // Consultar la base de datos para obtener los datos del usuario
            $stmt = $conexion->prepare("SELECT * FROM registroalu WHERE CodeAlu = ?");
            $stmt->bind_param("s", $codeAlu);
            $stmt->execute();
            $result = $stmt->get_result();
            // Verificar si se encontró un registro
            if($result->num_rows === 1) {
                $mostrar = $result->fetch_assoc();
                // Mostrar los datos del usuario
        ?>
            <div class="contenidoImg">
                <?php echo $mostrar["AluImage"]; ?>
            </div>
            <div class="c_code">
                <h3><?php echo $mostrar["CodeAlu"]; ?></h3>
            </div>
            <div class="c_nombre">
                <h3><?php echo $mostrar["AluNom"]; ?> <?php echo $mostrar["AluApellidoP"]; ?> <?php echo $mostrar["AluApellidoM"]; ?></h3>
            </div>
            <div class="c_carrera">
                <h4><?php echo $mostrar["AluCarrera"]; ?></h4>
            </div>
            <div class="c_correo">
                <h4><?php echo $mostrar["AluCorreo"]; ?></h4>
            </div>
        <?php
            } else {
                // Mostrar un mensaje si no se encuentra el usuario en la base de datos
                echo "<p>No se encontraron datos de usuario.</p>";
            }
        ?>
        <!-- Botones para mandar informacion -->
        <section class="vendedores contenedor">
            <a href="vendedores.php">Registrarse como vendedores</a>
        </section>
    </div>
</body>
</html>
