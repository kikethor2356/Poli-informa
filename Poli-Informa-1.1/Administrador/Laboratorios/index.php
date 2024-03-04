<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro de laboratorio</title>
    <style>
        form {
            max-width: 400px;
            margin: 0 auto;
        }
        input[type="text"] {
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
    <center>
        <h2>Formulario de Registro de Laboratorio</h2>
    </center>
    <form action="ControllerCreate.php" method="post" enctype="multipart/form-data">
        <label for="nombre_laboratorio">Nombre del laboratorio:</label>
        <input type="text" id="nombre_laboratorio" name="nombre_laboratorio" required>
        
        <input type="submit" value="Enviar">
    </form>
</body>
</html>
