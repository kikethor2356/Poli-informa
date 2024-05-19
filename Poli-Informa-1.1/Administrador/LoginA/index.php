<?php 
    session_start();
    // Verificar si hay una sesión activa como alumno
    if (!empty($_SESSION['CodeAlu'])) {
        header("Location: ../Avisos/AdminAvisos.php");
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
    <link rel="stylesheet" href="css/diseñologinAdmin.css">
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
                    <input type="text" name="AdCode" id="AdCode" placeholder=" ">
                    <label for="AdCode">Código</label>
                    <i class="fa-regular fa-user"></i>
                </div>
                <div class="elemento">
                    <input type="password" name="AdPassword" id="AdPassword" placeholder=" ">
                    <label for="AdPassword">Contraseña</label>
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
        <!-- Ventanas de emergencia para saber si ubo un error -->
        <?php
        if(isset($_GET['message'])){
            $message = $_GET['message'];
            switch ($message){
                case 'ok':
                    echo "<script>
                        Swal.fire({
                            title: 'Revisa',
                            text: 'Por favor revisa tu correo',
                            icon: 'warning',
                            confirmButtonText: 'Aceptar'
                        });
                    </script>";
                    break;
                    
                case 'success_password':
                    echo "<script>
                        Swal.fire({
                            title: 'Éxito',
                            text: 'Inicia sesión con tu nueva contraseña',
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        });
                    </script>";
                    break;

                case 'locked_time':
                    $unlock_time = isset($_GET['unlock_time']) ? $_GET['unlock_time'] : 'desconocido';
                    echo "<script>
                        Swal.fire({
                            title: 'Bloqueado',
                            text: 'Has alcanzado el número máximo de intentos. Inténtalo de nuevo a las {$unlock_time}.',
                            icon: 'error',
                            confirmButtonText: 'Cerrar'
                        });
                    </script>";
                    break;

                case 'error':
                    // Verificar si se pasó el parámetro de intentos restantes
                    $remaining_attempts = isset($_GET['remaining_attempts']) ? $_GET['remaining_attempts'] : '';
                    if (!empty($remaining_attempts)) {
                        echo "<script>
                            Swal.fire({
                                title: 'Error',
                                text: 'Codigo o contraseña incorrecta. Te quedan {$remaining_attempts} intentos.',
                                icon: 'error',
                                confirmButtonText: 'Cerrar'
                            });
                        </script>";
                    } else {
                        echo "<script>
                            Swal.fire({
                                title: 'Error',
                                text: 'Algo salió mal, inténtelo de nuevo',
                                icon: 'error',
                                confirmButtonText: 'Cerrar'
                            });
                        </script>";
                    }
                    break;

                case 'user_not_found':
                    echo "<script>
                        Swal.fire({
                            title: 'Error',
                            text: 'Los datos proporcionados no fueron reconocidos. Por favor, inténtalo de nuevo.',
                            icon: 'error',
                            confirmButtonText: 'Cerrar'
                        });
                    </script>";
                    break;

                default:
                    echo "<script>
                        Swal.fire({
                            title: 'Error',
                            text: 'Algo salió mal, inténtelo de nuevo',
                            icon: 'error',
                            confirmButtonText: 'Cerrar'
                        });
                    </script>";
                    break;
            }
        }
        ?>
    </div>
</body>
</html>