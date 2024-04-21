<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="footer-page/style.css">
    <link rel="stylesheet" href="../Partes/footer-page/style.css"> 

    <title>Bienvenido a la seccion de horarios</title>
</head>

<body>

<style>
    
   
</style>

    <?php

    include "../Partes/MenuUsuario.html";  

    ?>
    <section class="hero">
        <div class="content">
            <h1>Bienvenido a la sección de horarios</h1>
            <p>Este es la sección donde puedes visualizar cualquier horario</p>
            <a href="#container-horarios" class="a_Start">Empecemos</a>
        </div>
    </section>

    <div class="container-horarios" id="container-horarios">
        <section class="content-1">
            <div class="question">
                <h2>¿Qué es esta sección horarios?</h2>
            </div>
            <div class="container_descripcion">
                <p>En esta sección puedes buscar cualquier horario del Politécnico,
                    ya sea de aulas, laboratorios, talleres, etc.
                    Aquí encontrarás la información que necesitas para organizar tus actividades
                    académicas de manera eficiente.
                </p>
            </div>
            <div class="contenido_horarios">
                <form action="" method="POST">
                    <?php
                    include "../../Conexion/conexion.php";  //incluir la conexión
                    $database = new Database(); 
                    $db = $database->connect();
                    include "../../Administrador/Horarios/Componentes/ComboBoxMaestros.php";
                    $opciones = obtenerOpcionesCombo($db, "laboratorios");
                    // Mostrar las opciones en un combo box
                    ?>
                    <select name="nombre_laboratorio" class="selector-lab">
                    <?php
                    foreach ($opciones as $opcion) {
                        ?>
                            <option class="option" value='<?php echo $opcion;?>'><?php echo $opcion; ?></option>
                        <?php
                    }
                    ?>
                    </select>
                    <button class="button" type="submit">Buscar</button>
                </form>

                

                <?php
                // Mostrar el horario cuando se carga la página inicialmente
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $nombre_laboratorio = $_POST['nombre_laboratorio'];
                    $query = "SELECT id, dias, hora_inicio, hora_fin, maestro FROM horarios WHERE nombre_laboratorio = ?";
                    $stmt = $db->prepare($query);
                    $stmt->bind_param('s', $nombre_laboratorio);
                    $stmt->execute();
                    $resultado = $stmt->get_result();

                    $horario = array(
                        'Lunes' => array(),
                        'Martes' => array(),
                        'Miercoles' => array(),
                        'Jueves' => array(),
                        'Viernes' => array(),
                        'Sabado' => array(),
                    );

                    while ($fila = $resultado->fetch_assoc()) {
                        $id = $fila['id'];
                        $dias = $fila['dias'];
                        $hora_inicio = $fila['hora_inicio'];
                        $hora_fin = $fila['hora_fin'];
                        $maestro = $fila['maestro'];

                        // Agregar el horario al día correspondiente
                        if (isset($horario[$dias])) {
                            $horario[$dias][] = array('id' => $id, 'hora_inicio' => $hora_inicio, 'hora_fin' => $hora_fin, 'maestro' => $maestro);
                        } else {
                            // Si el día no está configurado correctamente, mostrar un mensaje de error
                            echo "Error: Día inválido: $dias";
                        }
                    }

                    // Mostrar la tabla de horarios
                    echo "<h1 class='h1-lab'>$nombre_laboratorio</h1>";
                    echo "<table  border:'4 '; class='table'>";
                    echo "<tr><th style='background-color: #1e071e; color: #FFFFFF; padding: 8px; text-align: center; font-family:Arial;'>Horario</th>";
                    foreach (['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'] as $dia) {
                        echo "<th style='background-color: #1e071e; color: #FFFFFF; padding: 8px; text-align: center; font-family:Arial;'>$dia</th>";
                    }
                    echo "</tr>";

                    // Generar las filas de la tabla
                    for ($i = 7; $i < 20; $i++) {
                        echo "<tr>";
                        $hora_inicio = str_pad($i, 2, "0", STR_PAD_LEFT) . ":00";
                        $hora_fin = str_pad(($i + 1), 2, "0", STR_PAD_LEFT) . ":00";
                        echo "<td style=' border: 1px solid black; background-color: #781c77; color: black; padding: 8px; text-align: center; font-family:Arial; color:	#f8f9fa;'>$hora_inicio - $hora_fin</td>";

                        foreach (['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'] as $dia) {
                            echo "<td style='background-color: #FFFFFF; color: black; padding: 8px; text-align: center; font-family:Arial; border: 1px solid black'>";
                            if (isset($horario[$dia])) {
                                foreach ($horario[$dia] as $hora) {
                                    if ($i >= (int)$hora['hora_inicio'] && $i <=  (int)$hora['hora_fin'] - 1) {
                                        echo '<a href="../../Administrador/Horarios/ControllerShowProfile.php?nombre=' . $hora["maestro"] . '" style="margin-right: 10px; text-decoration: none; color: black ;">' . $hora["maestro"] . '</a>';
                                    }
                                }
                            }
                            echo "</td>";
                        }
                        echo "</tr>";
                    }

                    echo "</table>";
                    echo "<br>";
                }
                ?>
            </div>
        </section>
    </div>
     <?php include "footer.html";  ?> 

    <script src="script/main.js"></script>
</body>
</html>
