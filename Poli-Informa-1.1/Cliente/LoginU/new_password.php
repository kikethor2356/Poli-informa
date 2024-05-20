<?php
session_start();
include('../../Conexion/conexion.php');
$db = new Database();
$conexion = $db->connect();

if (isset($_COOKIE['recovery_token'])) {
    $token = $_COOKIE['recovery_token'];
    $sql = "SELECT * FROM registroalu WHERE recovery_token = ? AND token_expiration > NOW()";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];
        $login_attempts = $row['login_attempts'];
        $last_attempt = strtotime($row['last_attempt']);
        $current_time = time();
        $lockout_time = 15 * 60; // 15 minutes lockout period

        // Check if the user is locked out
        if ($login_attempts >= 3 && ($current_time - $last_attempt) < $lockout_time) {
            header("Location: ../index.php?message=locked_out");
            exit();
        }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/diseño.css">
    <script src="JS/java.js"></script>
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
    
    <?php
    if (isset($_GET['message']) && $_GET['message'] === 'password_used') {
        echo "<script>
                Swal.fire({
                    icon: 'warning',
                    title: '¡Advertencia!',
                    text: 'Esta contraseña ya ha sido utilizada anteriormente. Por favor, elige una contraseña diferente.',
                    confirmButtonText: 'Entendido'
                });
              </script>";
    }
    ?>
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