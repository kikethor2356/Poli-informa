<?php
session_start();
include('../../Conexion/conexion.php');
$db = new Database();
$conexion = $db->connect();

if(isset($_GET['token'])) {
    $token = $_GET['token'];
    $sql = "SELECT * FROM registroalu WHERE recovery_token = '$token' AND token_expiration > NOW()";
    $result = $conexion->query($sql);

    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script src="JS/java.js"></script>
    <link rel="stylesheet" href="style/diseño.css">
    <title>Cambiar Contraseña</title>
</head>
<body>
    <img src="Img/fondo.png" alt="fondo" id="fondo">
    <div class="contenedor_inicio_sesion" style="height: 65vh;">
        <div class="inicio_sesion">
            <div class="elemento">
                <img src="Img/usuario.png" alt="img_usuario">
            </div>
            <div class="elemento">
                <h1>Recuperar contraseña</h1>
            </div>
            <form action="PHP/nueva_recovery.php" method="post" enctype="multipart/form-data">
                <div class="elemento">
                    <input type="text" name="new_pass" id="new_pass" placeholder=" ">
                    <input type="hidden" name="id" value="<?php echo $user_id; ?>">
                    <label for="correo">Nueva contraseña</label>
                    <i class="fa-regular fa-user"></i>
                </div>
                <div class="elemento">
                    <button type="submit" id="btn_iniciar_sesion" name="btn_iniciar_sesion">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php
    } else {
        header("Location: olvido.php?message=token_invalido");
    }
} else {
    header("Location: olvido.php?message=token_invalido");
}
?>
