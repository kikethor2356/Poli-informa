<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>EDITAR CATEGORIA</h1>
    <form action="modificar_categoria.php" method="post" enctype="multipart/form-data">
        <?php
            $id_categoria = $_GET['id_categoria'];
            require '../../Conexion/conexion.php';
 
            $buscar = mysqli_query($conexion, "SELECT * FROM avisos WHERE id_categoria='$id_categoria'");
            $fila = mysqli_fetch_array($buscar);
            $categoria = $fila['categoria'];
            $foto = $fila['foto'];
        
            echo '<label>Nombre de categoria</label>';
            echo '<input type="hidden" name="id_categoria" value="'.$id_categoria.'">';
            echo '<input REQUIRED type="text" name="categoria" value="'.$fila['categoria'].'"><br><br><br>';

            echo '<label>Elegir imagen:    </label>';
            echo '<input type="file" name="foto" id="imagenInput" onchange="previewImage()"><br><br><br>';
            echo '<img src="'.$foto.'" id="imagenPreview" width=80px height=auto>';
            echo '<label id="fileNameDisplay">'.$fila['foto'].'</label><br><br>';

            // Agregar el campo oculto para almacenar la imagen actual
            echo '<input type="hidden" name="imagen_actual" value="'.$foto.'">';

            echo '<input type="submit" value="Guardar">';
            echo '<button type="submit"><a href="vista_categoria.php">Cancelar</a></button';
        ?>
    </form>

    <script>
function previewImage() {
    var preview = document.getElementById('imagenPreview');
    var fileInput = document.getElementById('imagenInput');
    var fileNameDisplay = document.getElementById('fileNameDisplay');
    var file = fileInput.files[0];
    var reader = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
    }

    if (file) {
        reader.readAsDataURL(file);
        fileNameDisplay.textContent = file.name; // Mostrar el nombre del archivo
    } else {
        preview.src = "";
        fileNameDisplay.textContent = "No se seleccionó ningún archivo";
    }
}

</script>
</body>
</html>
