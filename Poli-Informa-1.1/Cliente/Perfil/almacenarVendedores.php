<?php 

    $conexion = new mysqli("localhost", "root", "", "poli_informa");

    if(isset($_POST['guardar'])){

        $nombre = $_POST['nombre'];
        $codigoEstudiante = $_POST['codigo'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $descripcion = $_POST['descripcion'];
        $horaInicio = $_POST['hora-inicio'];
        $horaFin = $_POST['hora-fin'];
        $archivo = $_FILES['imagen']['name'];
        $temporal = $_FILES['imagen']['tmp_name'];
        $carpeta = 'imagenes';

        if(!empty($archivo) && !empty($temporal)){

            if(!file_exists($carpeta)){

                mkdir($carpeta, 0777, true);

            }

            $ruta = $carpeta . "/" . $archivo;

            if(!move_uploaded_file($temporal, $ruta)){
                echo "Ocurrio un error al enviar la imagen";
            }


        }

        $stmt = $conexion->prepare("INSERT INTO VENDEDORES_PENDIENTES (codigoVendedor, nombre, descripcion, correo, telefono, horaInicio, horaFin, foto) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssss", $nombre, $codigoEstudiante, $correo, $telefono, $descripcion, $horaInicio, $horaFin, $archivo);

        $stmt->execute();

        $stmt->close();
        
        $conexion->close();

        header("Location: perfil.php");
        
        exit();

    }


?>