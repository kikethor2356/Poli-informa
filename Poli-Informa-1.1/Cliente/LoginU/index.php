<?php 
    session_start();
    // Verificar si hay una sesión activa
    if (!empty($_SESSION['CodeAlu'])) {
        header("Location: ../Avisos/Avisos.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script src="JS/java.js"></script>
    <link rel="stylesheet" href="style/diseño.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Iniciar sesión</title>
</head>
<body>
    <img src="Img/fondo.png" alt="fondo" id="fondo">
    <div class="contenedor_inicio_sesion">
        <div class="inicio_sesion">
            <div class="elemento">
                <img src="Img/usuario.png" alt="img_usuario">
            </div>
            <div class="elemento">
                <h1>BIENVENIDO</h1>
            </div>
            <form action="PHP/BD.php" method="post" enctype="multipart/form-data">
                <div class="elemento">
                    <input type="text" name="CodeAlu" id="CodeAlu" placeholder=" ">
                    <label for="CodeAlu">Código</label>
                    <i class="fa-regular fa-user"></i>
                </div>
                <div class="elemento">
                    <input type="password" name="AluPassword" id="AluPassword" placeholder=" ">
                    <label for="AluPassword">Contraseña</label>
                    <i class="fa-solid fa-lock"></i>
                    <a href="#" id="link_ver_contraseña"><i class="fa-regular fa-eye"></i></a>
                </div>
                <div class="elemento">
                    <button type="submit" id="btn_iniciar_sesion" name="btn_iniciar_sesion">Iniciar sesión</button>
                </div>
                <div class="elemento">
                    <a href="olvido.php">¿Olvidaste tu contraseña?</a>
                </div>
            </form>
        </div>

        <?php
            if(isset($_GET['message'])){
                ?>
                    <div>
                        <?php
                            switch ($_GET['message']){
                                case 'ok':
                                    echo "<script>
                                        Swal.fire({
                                            title: 'Revisa',
                                            text: 'Porfavor revisa tu correo',
                                            icon: 'warning',
                                            confirmButtonText: 'Aceptar'
                                        });
                                    </script>";
                                break;

                                case 'success_password':
                                    echo "<script>
                                        Swal.fire({
                                            title: 'Revisa',
                                            text: 'Inicia sesion con tu nueva contraseña',
                                            icon: 'success',
                                            confirmButtonText: 'Aceptar'
                                        });
                                    </script>";
                                break;

                                default:
                                    echo "<script>
                                        Swal.fire({
                                            title: 'Error',
                                            text: 'Algo salio mal, intentelo de nuevo',
                                            icon: 'error',
                                            confirmButtonText: 'Cerrar'
                                        });
                                    </script>";
                                break;
                            }
                        ?>
                    </div>
                <?php
            }
        ?>
    </div>
</body>
</html>