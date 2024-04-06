
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    

    <title>Bienvenido a la seccion de horarios</title>
    
</head>
<body>
    <section class="hero">
        <div class="content">
            <h1>Bienvenido a la sección de horarios</h1>
            <p>Este es la sección donde puedes visualizar cualquier horario</p>
            <a href="#container-horarios" class="a_Start">Empecemos</a>
        </div>
    </section>

    <div  class="container-horarios" id="container-horarios">
    
        <section class="content-1">
            <div class="question">
                <h2 >¿Qué es esta sección horarios?</h2>
            </div>
            <div class="container_descripcion">
                <p>En esta sección puedes buscar cualquier horario del Politécnico, 
                    ya sea de aulas, laboratorios, talleres, etc. 
                    Aquí encontrarás la información que necesitas para organizar tus actividades 
                    académicas de manera eficiente.
                </p>
            </div>
            <div class="contenido_horarios">

                <form action="../../Administrador/Horarios/VistaHorarios.php" method="POST">
                    <?php

                include "../../Conexion/conexion.php";  //incluir la conexión
                    $database = new Database();
                    $db = $database->connect();
                    include "../../Administrador/Horarios/Componentes/ComboBoxMaestros.php";
                    mostrarOpcionesLaboratorios($db);

                    ?>
                    <button type="submit">Buscar</button>
                </form> 
            </div>
        </section>
    </div>



    <script src="script/main.js"></script>
</body>
</html>
