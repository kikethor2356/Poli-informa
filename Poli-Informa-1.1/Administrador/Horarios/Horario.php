<?php


class Horario
{
  private $conn;
  private $table = 'horarios';
  private $maestro;
  private $hora_inicio;
  private $hora_fin;
  private $dias;
  private $nombre_laboratorio;
  private $turno;
  private $grupo;
  private $carrera;

  public function __construct($db)
  {
    $this->conn = $db;
  }

  // Método para establecer las variables del horario
  public function setHorario($maestro, $hora_inicio, $hora_fin, $dias, $nombre_laboratorio, $turno, $grupo, $carrera)
  {
    $this->maestro = $maestro;
    $this->hora_inicio = $hora_inicio;
    $this->hora_fin = $hora_fin;
    $this->dias = $dias;
    $this->nombre_laboratorio = $nombre_laboratorio;
    $this->turno = $turno;
    $this->grupo = $grupo;
    $this->carrera = $carrera;
  }

  public function create()
  {
    // Verificar si hay un registro con el mismo nombre de laboratorio, hora de inicio, hora de fin y día
    $query_check = "SELECT * FROM " . $this->table . " WHERE nombre_laboratorio = ? AND hora_inicio = ? AND hora_fin = ? AND dias = ?";
    $stmt_check = $this->conn->prepare($query_check);
    $stmt_check->bind_param('ssss', $this->nombre_laboratorio, $this->hora_inicio, $this->hora_fin, $this->dias);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    if ($result->num_rows > 0) {
      // Si se encontró un registro, enviar un mensaje al cliente para mostrar la alerta
      echo "<script>alert('Ya existe esa clase');</script>";
      return false;
    }

    // Si no se encontró ningún registro, proceder con la inserción

    $query_insert = 'INSERT INTO ' . $this->table . ' (maestro, nombre_laboratorio, hora_inicio, hora_fin, dias, turno, grupo, carrera) VALUES (?,?,?,?,?,?,?,?)';
    $stmt_insert = $this->conn->prepare($query_insert);
    $stmt_insert->bind_param('ssssssss', $this->maestro, $this->nombre_laboratorio, $this->hora_inicio, $this->hora_fin, $this->dias, $this->turno, $this->grupo, $this->carrera);

    if ($stmt_insert->execute()) {
      return true;
    }

    printf("Error: %s.\n", $stmt_insert->error);

    return false;
  }



  public function obtenerHorario($nombre_laboratorio)
  {
    $query = "SELECT id, dias, hora_inicio, hora_fin, maestro, grupo, carrera FROM $this->table WHERE nombre_laboratorio = ?";
    $stmt = $this->conn->prepare($query);
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
      $turno = $fila['turno'];
      $grupo = $fila['grupo'];
      $carrera = $fila['carrera'];

      // Agregar el horario al día correspondiente
      if (isset($horario[$dias])) {
        $horario[$dias][] = array('id' => $id, 'hora_inicio' => $hora_inicio, 'hora_fin' => $hora_fin, 'maestro' => $maestro, 'carrera' => $carrera, 'grupo' => $grupo);
      } else {
        // Si el día no está configurado correctamente, mostrar un mensaje de error
        echo "Error: Día inválido: $dias";
      }
    }

    return array('nombre_laboratorio' => $nombre_laboratorio, 'horario' => $horario);
  }

  public function mostrarHorario($nombre_laboratorio)
  {
    $datos_horario = $this->obtenerHorario($nombre_laboratorio);
    $nombre_laboratorio = $datos_horario['nombre_laboratorio'];
    $horario = $datos_horario['horario'];

    // Crear la tabla de horarios

?>


    <!DOCTYPE html>
    <html lang="es">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="../Menu/menu.css">
      <title>Formulario</title>



      <script>
        function mostrarFormulario() {
          var formulario = document.getElementById("formulario");
          if (formulario.style.display === "none") {
            formulario.style.display = "block";
          } else {
            formulario.style.display = "none";
          }
        }
      </script>
    </head>

    <body>
      <style>
        #productos {
          position: absolute;
          left: 0%;
          top: 0%;
          width: 100%;
          height: 100vh;
        }

        #principal-productos {
          position: absolute;
        }

        #principal-productos {
          width: 85%;
          height: 100%;
          top: 0%;
          left: 15%;
          background-color: white;
        }
      </style>
      <div id="productos">
        <main id="principal-productos">
          <section id="section-productos">
            <?php include '../Menu/menu.html'; ?>

            <?php
            echo "<h1 style='text-align: center; font-family:Arial; color: black;'>$nombre_laboratorio</h1>";
            echo "<div style='text-align: center; margin-bottom: 20px; font-family: Arial, sans-serif;'>";
            echo "<div style='display: inline-block; margin-right: 10px;'><a href='../../Administrador/Laboratorios/index.php' style='text-decoration: none; color: white; background-color: #28a745; padding: 10px 20px; border-radius: 5px;'>Agregar Laboratorio</a></div>";
            echo "<div style='display: inline-block; margin-right: 10px;'><a href='../../Administrador/Maestros/ControllerShowTable.php' style='text-decoration: none; color: white; background-color: #6610f2; padding: 10px 20px; border-radius: 5px;'>Agregar Maestro</a></div>";
            echo "<div style='display: inline-block;'><a href='indexAdmin.php' style='text-decoration: none; color: white; background-color: #17a2b8; padding: 10px 20px; border-radius: 5px;'>Regresar</a></div>";
            echo "<button onclick='mostrarFormulario()' style='background-color: #ffc107; color: white; border: none; padding: 10px 20px;font-size: 17px; border-radius: 5px; cursor: pointer; margin-left: 10px;'>Agregar clase</button>";
            echo "</div>";


            ?>


            <form id="formulario" action="ControllerCreate.php" method="post" style="display: none; margin-top: 20px; text-align: center; ">
              <?php
              $database = new Database();
              $db = $database->connect();
              // Incluir funciones para mostrar opciones de maestros y laboratorios
              include "Componentes/ComboBoxMaestros.php";
              mostrarOpcionesMaestros($db);
              ?>
              <input type="hidden" name="nombre_laboratorio" value="<?php echo $nombre_laboratorio; ?>">
              <select name="hora_inicio" id="hora_inicio" style="margin: 10px; padding: 8px; background:	#28a745; border-radius: 10%">
                <option value="7:00 am">7:00am</option>
                <option value="8:00 am">8:00am</option>
                <option value="9:00 am">9:00am</option>
                <option value="10:00 am">10:00am</option>
                <option value="11:00 am">11:00am</option>
                <option value="12:00 pm">12:00pm</option>
                <option value="13:00 pm">1:00pm</option>
                <option value="14:00 pm">2:00pm</option>
                <option value="15:00 pm">3:00pm</option>
                <option value="16:00 pm">4:00pm</option>
                <option value="17:00 pm">5:00pm</option>
                <option value="18:00 pm">6:00pm</option>
                <option value="19:00 pm">7:00pm</option>
                <option value="20:00 pm">8:00pm</option>
              </select>
              <select name="hora_fin" id="hora_fin" style="margin: 10px; padding: 8px; background:#17a2b8; border-radius: 10%">
                <option value="8:00 am">8:00am</option>
                <option value="9:00 am">9:00am</option>
                <option value="10:00 am">10:00am</option>
                <option value="11:00 am">11:00am</option>
                <option value="12:00 pm">12:00pm</option>
                <option value="13:00 pm">1:00pm</option>
                <option value="14:00 pm">2:00pm</option>
                <option value="15:00 pm">3:00pm</option>
                <option value="16:00 pm">4:00pm</option>
                <option value="17:00 pm">5:00pm</option>
                <option value="18:00 pm">6:00pm</option>
                <option value="19:00 pm">7:00pm</option>
                <option value="20:00 pm">8:00pm</option>
              </select>
              <select name="dias" id="dia_semana" style="margin: 10px; padding: 8px; background:#ffc107; border-radius:10%;">
                <option value="Lunes">Lunes</option>
                <option value="Martes">Martes</option>
                <option value="Miercoles">Miercoles</option>
                <option value="Jueves">Jueves</option>
                <option value="Viernes">Viernes</option>
                <option value="Sábado">Sábado</option>
              </select>
              <select name="turno" id="turno" style="margin: 10px; padding: 8px; background:#dc3545;border-radius: 10%;">
                <option value="Matutino">Matutino</option>
                <option value="Vespertino">Vespertino</option>
              </select>
              <select name="grupo" id="grupo" style="margin: 10px; padding: 8px; background:#dc3545;border-radius: 10%;">
                <option value="A">A</option>
                <option value="B">B</option>
              </select><select name="carrera" id="carrera" style="margin: 10px; padding: 8px; background:#ffc543;border-radius: 10%;">
                <option value="TPSI">TPSI</option>
                <option value="TPIQ">TPIQ</option>
              </select>
              <input type="submit" name="submit" value="Guardar" style="margin-top: 10px; padding: 10px 16px; background-color: #343a40 ; color: #FFFFFF; border: none; border-radius: 10%; cursor: pointer;">

            </form>

    </body>

    </html>



    <?php
    echo "<table border='4' style='border-collapse: collapse; width: 100%; background-color: #FFFFFF;'>";
    echo "<tr><th style='background-color: #073b4c; color: #FFFFFF; padding: 8px; text-align: center; font-family:Arial;'>Horario</th>";
    foreach (['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'] as $dia) {
      echo "<th style='background-color: #073b4c; color: #FFFFFF; padding: 8px; text-align: center; font-family:Arial;'>$dia</th>";
    }
    echo "</tr>";

    // Generar las filas de la tabla
    for ($i = 7; $i < 20; $i++) {
      echo "<tr>";
      $hora_inicio = str_pad($i, 2, "0", STR_PAD_LEFT) . ":00";
      $hora_fin = str_pad(($i + 1), 2, "0", STR_PAD_LEFT) . ":00";
      echo "<td style=' border: 1px solid black; background-color: #28a745; color: black; padding: 8px; text-align: center; font-family:Arial; color:	#f8f9fa;'>$hora_inicio - $hora_fin</td>";

      foreach (['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'] as $dia) {
        echo "<td style='background-color: #FFFFFF; color: black; padding: 8px; text-align: center; font-family:Arial; border: 1px solid black'>";
        if (isset($horario[$dia])) {
          foreach ($horario[$dia] as $hora) {
            if ($i >= (int)$hora['hora_inicio'] && $i <=  (int)$hora['hora_fin'] - 1) {
              echo '<p>';
              echo '<a href="ControllerShowProfile.php?nombre=' . $hora["maestro"] . '" style="margin-right: 10px; text-decoration: none; color: black ;">' . $hora["maestro"] . '</a>';
              echo  $hora['carrera'] . ' Grupo:' . $hora['grupo'];
              echo '</p>';
              echo "<a href='ControllerEdit.php?id=" . $hora['id'] . "' style='margin-right: 10px; display: inline-block; padding: 8px 16px; text-align: center; text-decoration: none; border-radius: 4px; background-color: #ffd166; color: #000; border: 1px solid #ffd166; transition: background-color 0.3s;'>Editar</a>";
              echo "<a href='ControllerDelete.php?id=" . $hora['id'] . "' style='display: inline-block; padding: 8px 16px; text-align: center; text-decoration: none; border-radius: 4px; background-color: #ef476f; color: #fff; border: 1px solid #ef476f; transition: background-color 0.3s;'>Eliminar</a>";
            }
          }
        }
        echo "</td>";
      }
      echo "</tr>";
    }

    echo "</table>";
    ?>
    </section>
    </main>
    </div>
    <?php
  }
  

  public function PerfilMaestros($maestro, $db)
  {
      // Preparar la consulta SQL para seleccionar un maestro basado en su ID
      $sql = "SELECT * FROM maestros WHERE nombre = ?";
      $stmt = $db->prepare($sql);
      $stmt->bind_param("s", $maestro);
      $stmt->execute();
      $result = $stmt->get_result();
  
      if ($result->num_rows > 0) {
          // Obtener el perfil del maestro    
          $row = $result->fetch_assoc();
  
  
  ?>
  
          <!DOCTYPE html>
          <html lang="en">
  
          <head>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
              <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
              <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
              <title>Perfil</title>
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
                      background-color: rgba(0, 0, 0, 0.4);
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
                      from {
                          opacity: 0
                      }
  
                      to {
                          opacity: 1
                      }
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
                      from {
                          opacity: 1
                      }
  
                      to {
                          opacity: 0
                      }
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
  
  
  
      } else {
          echo "No se encontró ningún maestro con ese nombre.";
      }
  
      $stmt->close();
  }
  
  
  





    function search($busqueda)
    {
      // Consulta SQL para buscar en la base de datos
      $sql = "SELECT * FROM $this->table WHERE nombre_laboratorio LIKE '%$busqueda%'";
      $resultado = $this->conn->query($sql);
      $datos_horario = $this->obtenerHorario($busqueda);
      $nombre_laboratorio = $datos_horario['nombre_laboratorio'];
      $horario = $datos_horario['horario'];

      $this->obtenerHorario($nombre_laboratorio);
      $this->mostrarHorario($nombre_laboratorio);
    }


    function editarRegistro($id, $nombre_laboratorio, $maestro, $hora_inicio, $hora_fin, $turno, $grupo, $carrera)
    {
      $database = new Database();
      $db = $database->connect();

      // Crear una instancia de la clase Horario
      // Consulta SQL para actualizar el registro en la base de datos
      $sql = "UPDATE $this->table SET nombre_laboratorio=?, maestro=?, hora_inicio=?, hora_fin=?, turno=?, grupo=?, carrera=? WHERE id=?";
      $stmt = $this->conn->prepare($sql);
      $stmt->bind_param('ssssssss', $nombre_laboratorio, $maestro, $hora_inicio, $hora_fin, $turno, $grupo, $carrera, $id);

      if ($stmt->execute()) {
        // Actualizar el horario después de editar el registro
        $this->obtenerHorario($nombre_laboratorio);
        // Mostrar el horario actualizado después de editar el registro
        $this->mostrarHorario($nombre_laboratorio);

        return "Registro actualizado correctamente";
      } else {
        return "Error al actualizar el registro: " . $this->conn->error;
      }
    }


    function mostrarFormularioEdicion($id, $db)
    {
      // Consulta SQL para obtener los datos del registro
      $sql = "SELECT * FROM $this->table WHERE id=?";
      $stmt = $this->conn->prepare($sql);
      $stmt->bind_param('i', $id);
      $stmt->execute();
      $resultado = $stmt->get_result();

      if ($resultado->num_rows > 0) {
        // Mostrar el formulario de edición con los datos actuales del registro
        $fila = $resultado->fetch_assoc();
        ?>
          <!DOCTYPE html>
          <html lang="en">

          <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Editando</title>
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
            <style>
              body {
                font-family: 'Poppins', sans-serif;
                background-color: #f5f5f5;
                margin: 0;
                padding: 0;
              }

              .container {
                max-width: 500px;
                margin: 50px auto;
                padding: 40px;
                border-radius: 20px;
                background-color: #fff;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
              }

              h2 {
                margin-bottom: 30px;
                text-align: center;
                color: #333;
                font-size: 32px;
              }

              .form-group {
                margin-bottom: 20px;
              }

              label {
                display: block;
                font-weight: bold;
                margin-bottom: 10px;
                color: #555;
                font-size: 18px;
              }

              select {
                width: 100%;
                padding: 12px;
                border-radius: 10px;
                border: 1px solid #ccc;
                background-color: #f9f9f9;
                color: #333;
                font-size: 16px;
              }

              input[type="submit"] {
                display: block;
                width: 100%;
                padding: 16px;
                font-size: 20px;
                background-color: #007bff;
                color: #fff;
                border: none;
                border-radius: 10px;
                cursor: pointer;
                transition: background-color 0.3s ease;
              }

              input[type="submit"]:hover {
                background-color: #0056b3;
              }
            </style>
          </head>

          <body>
            <div class="container">
              <h2>Editando</h2>
              <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">

                <div class="form-group">
                  <label for="maestro">Maestro</label>
                  <?php include "../Horarios/Componentes/Selectes.php";
                  mostrarOpcionesMaestrosEdicion($db, $fila['maestro']); ?>
                </div>

                <div class="form-group">
                  <label for="nombre_laboratorio">Nombre laboratorio</label>
                  <?php mostrarOpcionesLaboratoriosEdicion($db, $fila['nombre_laboratorio']); ?>
                </div>

                <div class="form-group">
                  <label for="hora_inicio">Hora de inicio</label>
                  <select name="hora_inicio">
                    <option value="7:00 am" <?php echo isset($fila['hora_inicio']) && $fila['hora_inicio'] == '7:00 am' ? 'selected' : ''; ?>>7:00 am</option>
                    <option value="8:00 am" <?php echo isset($fila['hora_inicio']) && $fila['hora_inicio'] == '8:00 am' ? 'selected' : ''; ?>>8:00 am</option>
                    <option value="9:00 am" <?php echo isset($fila['hora_inicio']) && $fila['hora_inicio'] == '9:00 am' ? 'selected' : ''; ?>>9:00 am</option>
                    <option value="10:00 am" <?php echo isset($fila['hora_inicio']) && $fila['hora_inicio'] == '10:00 am' ? 'selected' : ''; ?>>10:00 am</option>
                    <option value="11:00 am" <?php echo isset($fila['hora_inicio']) && $fila['hora_inicio'] == '11:00 am' ? 'selected' : ''; ?>>11:00 am</option>
                    <option value="12:00 pm" <?php echo isset($fila['hora_inicio']) && $fila['hora_inicio'] == '12:00 pm' ? 'selected' : ''; ?>>12:00 pm</option>
                    <option value="1:00 pm" <?php echo isset($fila['hora_inicio']) && $fila['hora_inicio'] == '1:00 pm' ? 'selected' : ''; ?>>1:00 pm</option>
                    <option value="2:00 pm" <?php echo isset($fila['hora_inicio']) && $fila['hora_inicio'] == '2:00 pm' ? 'selected' : ''; ?>>2:00 pm</option>
                    <option value="3:00 pm" <?php echo isset($fila['hora_inicio']) && $fila['hora_inicio'] == '3:00 pm' ? 'selected' : ''; ?>>3:00 pm</option>
                    <option value="4:00 pm" <?php echo isset($fila['hora_inicio']) && $fila['hora_inicio'] == '4:00 pm' ? 'selected' : ''; ?>>4:00 pm</option>
                    <option value="5:00 pm" <?php echo isset($fila['hora_inicio']) && $fila['hora_inicio'] == '5:00 pm' ? 'selected' : ''; ?>>5:00 pm</option>
                    <option value="6:00 pm" <?php echo isset($fila['hora_inicio']) && $fila['hora_inicio'] == '6:00 pm' ? 'selected' : ''; ?>>6:00 pm</option>
                    <option value="7:00 pm" <?php echo isset($fila['hora_inicio']) && $fila['hora_inicio'] == '7:00 pm' ? 'selected' : ''; ?>>7:00 pm</option>
                    <option value="8:00 pm" <?php echo isset($fila['hora_inicio']) && $fila['hora_inicio'] == '8:00 pm' ? 'selected' : ''; ?>>8:00 pm</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="hora_fin">Hora de fin</label>
                  <select name="hora_fin">
                    <option value="7:00 am" <?php echo isset($fila['hora_fin']) && $fila['hora_fin'] == '7:00 am' ? 'selected' : ''; ?>>7:00 am</option>
                    <option value="8:00 am" <?php echo isset($fila['hora_fin']) && $fila['hora_fin'] == '8:00 am' ? 'selected' : ''; ?>>8:00 am</option>
                    <option value="9:00 am" <?php echo isset($fila['hora_fin']) && $fila['hora_fin'] == '9:00 am' ? 'selected' : ''; ?>>9:00 am</option>
                    <option value="10:00 am" <?php echo isset($fila['hora_fin']) && $fila['hora_fin'] == '10:00 am' ? 'selected' : ''; ?>>10:00 am</option>
                    <option value="11:00 am" <?php echo isset($fila['hora_fin']) && $fila['hora_fin'] == '11:00 am' ? 'selected' : ''; ?>>11:00 am</option>
                    <option value="12:00 pm" <?php echo isset($fila['hora_fin']) && $fila['hora_fin'] == '12:00 pm' ? 'selected' : ''; ?>>12:00 pm</option>
                    <option value="1:00 pm" <?php echo isset($fila['hora_fin']) && $fila['hora_fin'] == '1:00 pm' ? 'selected' : ''; ?>>1:00 pm</option>
                    <option value="2:00 pm" <?php echo isset($fila['hora_fin']) && $fila['hora_fin'] == '2:00 pm' ? 'selected' : ''; ?>>2:00 pm</option>
                    <option value="3:00 pm" <?php echo isset($fila['hora_fin']) && $fila['hora_fin'] == '3:00 pm' ? 'selected' : ''; ?>>3:00 pm</option>
                    <option value="4:00 pm" <?php echo isset($fila['hora_fin']) && $fila['hora_fin'] == '4:00 pm' ? 'selected' : ''; ?>>4:00 pm</option>
                    <option value="5:00 pm" <?php echo isset($fila['hora_fin']) && $fila['hora_fin'] == '5:00 pm' ? 'selected' : ''; ?>>5:00 pm</option>
                    <option value="6:00 pm" <?php echo isset($fila['hora_fin']) && $fila['hora_fin'] == '6:00 pm' ? 'selected' : ''; ?>>6:00 pm</option>
                    <option value="7:00 pm" <?php echo isset($fila['hora_fin']) && $fila['hora_fin'] == '7:00 pm' ? 'selected' : ''; ?>>7:00 pm</option>
                    <option value="8:00 pm" <?php echo isset($fila['hora_fin']) && $fila['hora_fin'] == '8:00 pm' ? 'selected' : ''; ?>>8:00 pm</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="turno">Turno</label>
                  <select name="turno" id="turno">
                    <option value="Matutino" <?php echo isset($fila['turno']) && $fila['turno'] == 'Matutino' ? 'selected' : ''; ?>>Matutino</option>
                    <option value="Vespertino" <?php echo isset($fila['turno']) && $fila['turno'] == 'Vespertino' ? 'selected' : ''; ?>>Vespertino</option>

                  </select>
                </div>

                <div class="form-group">
                  <label for="grupo">Grupo</label>
                  <select name="grupo" id="grupo">
                    <option value="A" <?php echo isset($fila['grupo']) && $fila['grupo'] == 'A' ? 'selected' : ''; ?>>A</option>
                    <option value="B" <?php echo isset($fila['grupo']) && $fila['grupo'] == 'B' ? 'selected' : ''; ?>>B</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="carrera">Carrera</label>
                  <select name="carrera" id="carrera">
                    <option value="TPSI" <?php echo isset($fila['carrera']) && $fila['carrera'] == 'TPSI' ? 'selected' : ''; ?>>TPSI</option>
                    <option value="TPIQ" <?php echo isset($fila['carrera']) && $fila['carrera'] == 'TPIQ' ? 'selected' : ''; ?>></option>

                  </select>
                </div>

                <input type="submit" value="Guardar Cambios">
              </form>
            </div>
          </body>

          </html>




        <?php
      } else {
        echo "No se encontró ningún registro con el ID proporcionado";
      }
    }
    public function eliminarRegistro($id)
    {
      $database = new Database();
      $db = $database->connect();

      // Consulta SQL para eliminar el registro de la base de datos
      $sql = "DELETE FROM $this->table WHERE id=?";
      $stmt = $this->conn->prepare($sql);
      $stmt->bind_param('i', $id);

      if ($stmt->execute()) {
        // Si se eliminó correctamente, retornamos un mensaje de éxito
        echo "Registro eliminado correctamente";
        header('Location:indexAdmin.php');
      } else {
        // Si hubo un error al eliminar, retornamos un mensaje de error
        return "Error al eliminar el registro: " . $this->conn->error;
      }
    }









    function searchCliente($busqueda)
    {

      // Consulta SQL para buscar en la base de datos
      $sql = "SELECT * FROM $this->table WHERE nombre_laboratorio LIKE '%$busqueda%'";
      $resultado = $this->conn->query($sql);
      $datos_horario = $this->obtenerHorario($busqueda);
      $nombre_laboratorio = $datos_horario['nombre_laboratorio'];
      $horario = $datos_horario['horario'];

      $this->obtenerHorario($nombre_laboratorio);
      $this->mostrarHorarioCliente($nombre_laboratorio);
    }


    public function mostrarHorarioCliente($nombre_laboratorio)
    {
      $datos_horario = $this->obtenerHorario($nombre_laboratorio);
      $nombre_laboratorio = $datos_horario['nombre_laboratorio'];
      $horario = $datos_horario['horario'];

      // Crear la tabla de horarios
      echo "<h1 style='text-align: center; font-family:Arial; color: black;'>$nombre_laboratorio</h1>";
        ?>

    <?php
      echo "<table border='4' style='border-collapse: collapse; width: 100%; background-color: #FFFFFF;'>";
      echo "<tr><th style='background-color: #073b4c; color: #FFFFFF; padding: 8px; text-align: center; font-family:Arial;'>Horario</th>";
      foreach (['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'] as $dia) {
        echo "<th style='background-color: #073b4c; color: #FFFFFF; padding: 8px; text-align: center; font-family:Arial;'>$dia</th>";
      }
      echo "</tr>";

      // Generar las filas de la tabla
      for ($i = 7; $i < 20; $i++) {
        echo "<tr>";
        $hora_inicio = str_pad($i, 2, "0", STR_PAD_LEFT) . ":00";
        $hora_fin = str_pad(($i + 1), 2, "0", STR_PAD_LEFT) . ":00";
        echo "<td style=' border: 1px solid black; background-color: #28a745; color: black; padding: 8px; text-align: center; font-family:Arial; color:	#f8f9fa;'>$hora_inicio - $hora_fin</td>";

        foreach (['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'] as $dia) {
          echo "<td style='background-color: #FFFFFF; color: black; padding: 8px; text-align: center; font-family:Arial; border: 1px solid black'>";
          if (isset($horario[$dia])) {
            foreach ($horario[$dia] as $hora) {
              if ($i >= (int)$hora['hora_inicio'] && $i <=  (int)$hora['hora_fin'] - 1) {
                echo '<a href="ControllerShowProfile.php?nombre=' . $hora["maestro"] . '" style="margin-right: 10px; text-decoration: none; color: black ;">' . $hora["maestro"] . '</a>';
              }
            }
          }
          echo "</td>";
        }
        echo "</tr>";
      }

      echo "</table>";
    }
  }
