<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro de Maestro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        form {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
            color: #555;
        }
        input[type="text"], input[type="email"], input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        #imagen_preview {
            display: none;
            max-width: 100%;
            margin-top: 10px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h2>Registra a un maestro</h2>
    <form action="ControllerCreate.php" method="post" enctype="multipart/form-data">
        <label for="nombre_maestro">Nombre del Maestro:</label>
        <input type="text" id="nombre_maestro" name="nombre_maestro" required>

        <label for="apellidos_maestro">Apellidos del Maestro:</label>
        <input type="text" id="apellidos_maestro" name="apellidos_maestro" required>

        <label for="codigo_maestro">Código del Maestro:</label>
        <input type="text" id="codigo_maestro" name="codigo_maestro" required>

        <label for="correo_maestro">Correo Electrónico:</label>
        <input type="email" id="correo_maestro" name="correo_maestro" required>

        <label for="imagen_croquis2">Imagen Croquis (solo imágenes):</label>
        <input type="file" id="imagen_croquis2" name="imagen_croquis2" accept="image/*" required onchange="previsualizarImagen()">
      

        <label for="imagen_croquis">Imagen Profesor (solo imágenes):</label>
        <input type="file" id="imagen_croquis" name="imagen_croquis" accept="image/*" required onchange="previsualizarImagen()">
        <img id="imagen_preview" src="#" alt="Vista previa de la imagen">
        

        <input type="submit" value="Enviar">
    </form>

    <script>
        function previsualizarImagen() {
            var input = document.getElementById('imagen_croquis');
            var preview = document.getElementById('imagen_preview');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    preview.style.display = 'block';
                    preview.src = e.target.result;
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>
