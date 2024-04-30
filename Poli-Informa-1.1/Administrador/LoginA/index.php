<?php 
    session_start();
    // Verificar si hay una sesión activa como administrador
    if (!empty($_SESSION['AdCode'])) {
        header("Location: ../Avisos/vista_categoria.php");
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
                <input type="hidden" name="login_as_admin" value="1">
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
                <!-- <div class="elemento">
                    <a href="olvido.php">¿Olvidaste tu contraseña?</a>
                </div> -->
            </form>
        </div>

        <?php
            if(isset($_GET['message'])){
                ?>
                    <div>
                        <?php
                            switch ($_GET['message']){
                                case 'error':
                                    echo "<script>
                                        Swal.fire({
                                            title: 'Error',
                                            icon: 'error',
                                            text: 'Contraseña o codigo equivocada',
                                            confirmButtonText: 'Aceptar'
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