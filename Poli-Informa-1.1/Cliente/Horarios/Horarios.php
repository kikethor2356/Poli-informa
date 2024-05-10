<!-- <?php include '../LoginU/inicio.php'; ?> -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="footer-page/style.css">
    <link rel="stylesheet" href="../Partes/footer-page/style.css">

    <title>Bienvenido a la sección de horarios</title>
</head>

<body>
    <style>
    </style>

    <?php

    include "../Partes/MenuUsuario.php";

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
            <div class="contenido_horarios" id="horarios">
                <form action="#horarios" method="POST">
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
                            <option class="option" value='<?php echo $opcion; ?>'><?php echo $opcion; ?></option>


                            < <?php
                            }
                                ?> </select>
                                <select name="turno" id="turno" class="selector-lab">
                                    <option value="Matutino">Matutino</option>
                                    <option value="Vespertino">Vespertino</option>
                                </select>
                                <br>
                                <button class="button" type="submit">Buscar</button>
                </form>



                <?php
                // Mostrar el horario cuando se carga la página inicialmente
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $nombre_laboratorio = $_POST['nombre_laboratorio'];
                    $turno = $_POST['turno'];
                    $query = "SELECT id, dias, hora_inicio, hora_fin, maestro, turno FROM horarios WHERE nombre_laboratorio = ? && turno = ?";
                    $stmt = $db->prepare($query);
                    $stmt->bind_param('ss', $nombre_laboratorio, $turno);
                    $stmt->execute();
                    $resultado = $stmt->get_result();

                    if ($turno == "Matutino") {
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
                        echo "<h2>$turno</h2>";
                        echo "<table  border:'4 '; class='table'>";
                        echo "<tr><th style='background-color: #1e071e; color: #FFFFFF; padding: 8px; text-align: center; font-family:Arial;'>Horario</th>";
                        foreach (['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'] as $dia) {
                            echo "<th style='background-color: #1e071e; color: #FFFFFF; padding: 8px; text-align: center; font-family:Arial;'>$dia</th>";
                        }
                        echo "</tr>";

                        // Generar las filas de la tabla
                        for ($i = 7; $i < 14; $i++) {
                            echo "<tr>";
                            $hora_inicio = str_pad($i, 2, "0", STR_PAD_LEFT) . ":00";
                            $hora_fin = str_pad(($i + 1), 2, "0", STR_PAD_LEFT) . ":00";
                            echo "<td style=' border: 1px solid black; background-color: #781c77; color: black; padding: 8px; text-align: center; font-family:Arial; color:	#f8f9fa;'>$hora_inicio - $hora_fin</td>";

                            foreach (['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'] as $dia) {
                                echo "<td style='background-color: #FFFFFF; color: black; padding: 8px; text-align: center; font-family:Arial; border: 1px solid black'>";
                                if (isset($horario[$dia])) {
                                    foreach ($horario[$dia] as $hora) {
                                        if ($i >= (int)$hora['hora_inicio'] && $i <=  (int)$hora['hora_fin'] - 1) {
                                        ?>
                                            <button id="btnModal" style="border-radius: 10px; width: 100%;    height: 30px; background-color: white; "><?php echo $hora["maestro"]; ?></button>
                                        <?php
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

                    if ($turno == "Vespertino") {

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
                        echo "<h2>$turno</h2>";
                        echo "<table  border:'4 '; class='table'>";
                        echo "<tr><th style='background-color: #1e071e; color: #FFFFFF; padding: 8px; text-align: center; font-family:Arial;'>Horario</th>";
                        foreach (['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'] as $dia) {
                            echo "<th style='background-color: #1e071e; color: #FFFFFF; padding: 8px; text-align: center; font-family:Arial;'>$dia</th>";
                        }
                        echo "</tr>";

                        // Generar las filas de la tabla
                        for ($i = 14; $i < 21; $i++) {
                            echo "<tr>";
                            $hora_inicio = str_pad($i, 2, "0", STR_PAD_LEFT) . ":00";
                            $hora_fin = str_pad(($i + 1), 2, "0", STR_PAD_LEFT) . ":00";
                            echo "<td style=' border: 1px solid black; background-color: #781c77; color: black; padding: 8px; text-align: center; font-family:Arial; color:	#f8f9fa;'>$hora_inicio - $hora_fin</td>";

                            foreach (['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'] as $dia) {
                                echo "<td style='background-color: #FFFFFF; color: black; padding: 8px; text-align: center; font-family:Arial; border: 1px solid black'>";
                                if (isset($horario[$dia])) {
                                    foreach ($horario[$dia] as $hora) {
                                        if ($i >= (int)$hora['hora_inicio'] && $i <=  (int)$hora['hora_fin'] - 1) {
                                        ?>
                                            <button id="btnModal"><?php echo $hora["maestro"]; ?></button>
                                        <?php
                                          
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
                }
                ?>



            </div>
        </section>
    </div>

    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }

        .modal {

            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            position: relative;
            background-color: transparent;
            margin: 1%;
            margin-left: 30%;
            padding: 20px;
            border: 1px solid transparent;
            width: 50%;
            max-width: 600px;
            border-radius: 10px;
            animation-name: modalopen;
            animation-duration: 0.5s;
        }

        @keyframes modalopen {
            from {opacity: 0}
            to {opacity: 1}
        }

        .close {
            color: white;
            float: right;
            font-size: 30px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Animación de cierre del modal */
        .modal.fadeout {
            animation-name: modalfadeout;
            animation-duration: 0.5s;
        }

        @keyframes modalfadeout {
            from {opacity: 1}
            to {opacity: 0}
        }

        /* Estilos específicos del perfil */
        .profile {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .profile-name {
            font-size: 24px;
            margin: 5px 0;
        }

        .profile-email,
        .profile-code {
            font-size: 16px;
            margin: 5px 0;
            color: #777;
        }

        .profile-details {
            text-align: center;
            padding: 20px 0;
        }

        .section-title {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .profile-info {
            margin-left: 20px;
        }

        .profile-info p {
            margin: 5px 0;
        }

        .croquis img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <?php
                $id = $hora["maestro"];
                $sql = "SELECT * FROM maestros WHERE nombre = ?";
                $stmt = $db->prepare($sql);
                $stmt->bind_param("s", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result->num_rows > 0) {
                    // Obtener el perfil del maestro    
                    $row = $result->fetch_assoc();
            ?>
            <section class="profile">
                <div class="profile-header">
                    <img src="../../Administrador/Maestros/ImgCroquis/<?php echo $row['Imagen']; ?>" alt="Avatar" class="profile-avatar" />
                    <h1 class="profile-name"><?php echo $row["Nombre"] . " " . $row["Apellidos"]; ?></h1>
                    <p class="profile-email"><?php echo $row["Correo"]; ?></p>
                    <p class="profile-code">Código UDG: <?php echo $row["Codigo"]; ?></p>
                </div>
                <div class="profile-details">
                    <h2 class="section-title">Información Personal</h2>
                    <div class="profile-info">
                        <p><strong>Nombre:</strong> <?php echo $row["Nombre"]; ?></p>
                        <p><strong>Apellidos:</strong> <?php echo $row["Apellidos"]; ?></p>
                        <p><strong>Dirección aproximada:</strong>
                    </div>
                    <div class="croquis">
                        <img src="../../Administrador/Maestros/ImgCroquis/<?php echo $row['imagen_croquis']; ?>" alt="Croquis">
                    </div>
                    <!-- Agrega más detalles aquí si es necesario -->
                </div>
            </section>
            <?php
                }
            ?>
        </div>
    </div>

    
        </div>
    </div>
    <?php include "footer.html";  ?>

    <script src="script/main.js"></script>
</body>

</html>