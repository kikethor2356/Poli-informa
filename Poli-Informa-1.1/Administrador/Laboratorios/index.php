<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro de Laboratorio</title>
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
        input[type="text"] {
            width: calc(105.5% - 22px); /* El ancho del input es el 100% del formulario menos 22px de padding */
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff; /* Color de fondo azul */
            color: white;
            padding: 15px 0; /* Padding vertical de 15px y padding horizontal de 0 */
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%; /* El ancho del botón es igual al 100% del formulario */
            /* Añadimos transición para suavizar el cambio de color al pasar el ratón */
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #0056b3; /* Cambiamos el color de fondo al pasar el ratón */
        }
    </style>
</head>
<body>
    <h2>Formulario de Registro de Laboratorio</h2>
    <form action="ControllerCreate.php" method="post" enctype="multipart/form-data">
        <label for="nombre_laboratorio">Nombre del laboratorio:</label>
        <input type="text" id="nombre_laboratorio" name="nombre_laboratorio" required>
        
        <input type="submit" value="Enviar">
    </form>
</body>
</html>
