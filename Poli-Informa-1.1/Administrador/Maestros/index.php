<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro de Maestro</title>
    <style>
        form {
            max-width: 400px;
            margin: 0 auto;
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
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Formulario de Registro de Maestro</h2>
    <form action="ControllerCreate.php" method="post" enctype="multipart/form-data">
        <label for="nombre_maestro">Nombre del Maestro:</label>
        <input type="text" id="nombre_maestro" name="nombre_maestro" required>

        <label for="nombre_maestro">Apellidos del Maestro:</label>
        <input type="text" id="apellidos_maestro" name="apellidos_maestro" required>

        <label for="codigo_maestro">Código del Maestro:</label>
        <input type="text" id="codigo_maestro" name="codigo_maestro" required>

        <label for="correo_maestro">Correo Electrónico:</label>
        <input type="email" id="correo_maestro" name="correo_maestro" required>

        <label for="imagen_direccion">Cargar Imagen (solo imágenes):</label>
        <input type="file" id="imagen_croquis" name="imagen_croquis" accept="image/*" required>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>
