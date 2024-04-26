<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de comentarios</title>
</head>
<body>
    <div>
        <a href="ContactanosVista.php">Agregar</a>
        <table border="1">
            <tr>
                <td>ID</td>
                <td>Nombre</td>
                <td>Correo</td>
                <td>Comentario</td>
                <td>Opciones</td>
            </tr>
            <?php
                $cnx = mysqli_connect("localhost", "root", "", "poli_informa");
                $sql = "SELECT id, UsNombre, UsCorreo, UsComentario FROM venqys order by id desc";
                $rta = mysqli_query($conexion, $sql);
                while ($mostrar = mysqli_fetch_row($rta)) {
            ?>
            <tr>
                <td><?php echo $mostrar['0'] ?></td>
                <td><?php echo $mostrar['1'] ?></td>
                <td><?php echo $mostrar['2'] ?></td>
                <td><?php echo $mostrar['3'] ?></td>
                <td>
                    <a href="UsEditar.php">Editar</a>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
</body>
</html>   