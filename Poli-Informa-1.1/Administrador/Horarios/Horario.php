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

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Método para establecer las variables del horario
    public function setHorario($maestro, $hora_inicio, $hora_fin, $dias, $nombre_laboratorio, $turno)
    {
        $this->maestro = $maestro;
        $this->hora_inicio = $hora_inicio;
        $this->hora_fin = $hora_fin;
        $this->dias = $dias;
        $this->nombre_laboratorio = $nombre_laboratorio;
        $this->turno = $turno;
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
        $query_insert = 'INSERT INTO ' . $this->table . ' (maestro, nombre_laboratorio, hora_inicio, hora_fin, dias, turno) VALUES (?, ?, ?, ?, ?, ?)';
        $stmt_insert = $this->conn->prepare($query_insert);
        $stmt_insert->bind_param('ssssss', $this->maestro, $this->nombre_laboratorio, $this->hora_inicio, $this->hora_fin, $this->dias, $this->turno);

        if ($stmt_insert->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt_insert->error);

        return false;
    }



    public function obtenerHorario($nombre_laboratorio)
    {
        $query = "SELECT id, dias, hora_inicio, hora_fin, maestro FROM $this->table WHERE nombre_laboratorio = ?";
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

            // Agregar el horario al día correspondiente
            if (isset($horario[$dias])) {
                $horario[$dias][] = array('id' => $id, 'hora_inicio' => $hora_inicio, 'hora_fin' => $hora_fin, 'maestro' => $maestro);
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
        echo "<h1 style='text-align: center; color: black;'>$nombre_laboratorio</h1>";
        ?>


<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Formulario</title>
<script>
function mostrarFormulario() {
  document.getElementById("formulario").style.display = "block";
  // Aquí puedes cargar los datos del formulario si es necesario
}
</script>
</head>
<body>

<button onclick="mostrarFormulario()">Mostrar Formulario</button>

<form id="formulario" action="ControllerCreate.php" method="post" style="display: none; margin-top: 20px; text-align: center;">
  <?php
  $database = new Database();
  $db = $database->connect();
  // Incluir funciones para mostrar opciones de maestros y laboratorios
  include "Componentes/ComboBoxMaestros.php";
  mostrarOpcionesMaestros($db);
  ?>
  <input type="hidden" name="nombre_laboratorio" value="<?php echo $nombre_laboratorio; ?>">
         <select name="hora_inicio" id="hora_inicio" style="margin: 10px; padding: 8px;">
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
         <select name="hora_fin" id="hora_fin" style="margin: 10px; padding: 8px;">
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
         <select name="dias" id="dia_semana" style="margin: 10px; padding: 8px;">
             <option value="Lunes">Lunes</option>
             <option value="Martes">Martes</option>
             <option value="Miercoles">Miercoles</option>
             <option value="Jueves">Jueves</option>
             <option value="Viernes">Viernes</option>
             <option value="Sábado">Sábado</option>
         </select>
         <select name="turno" id="turno" style="margin: 10px; padding: 8px;">
             <option value="Matutino">Matutino</option>
             <option value="Vespertino">Vespertino</option>
         </select>
         <input type="submit" name="submit" value="Guardar" style="margin-top: 10px; padding: 8px 16px; background-color: #218380 ; color: #FFFFFF; border: none; border-radius: 5%; cursor: pointer;">

</form>

</body>
</html>


        
             <?php
      echo "<div style='text-align: left; margin-bottom: 20px;'>";
      echo "<div style='display: inline-block; margin-right: 10px;'><a href='../../Administrador/Laboratorios/index.php' style='text-decoration: none; color: white; background-color: green; padding: 10px 20px; border-radius: 5px;'>Agregar Laboratorio</a></div>";
      echo "<div style='display: inline-block;'><a href='indexAdmin.php' style='text-decoration: none; color: white; background-color: blue; padding: 10px 20px; border-radius: 5px;'>Regresar</a></div>";
      echo "</div>";
      
        echo "<table border='1' style='border-collapse: collapse; width: 100%; background-color: #FFFFFF;'>";
        echo "<tr><th style='background-color: #073b4c; color: #FFFFFF; padding: 8px; text-align: center;'>Horario</th>";
        foreach (['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'] as $dia) {
            echo "<th style='background-color: #073b4c; color: #FFFFFF; padding: 8px; text-align: center;'>$dia</th>";
        }
        echo "</tr>";
        
        // Generar las filas de la tabla
        for ($i = 7; $i < 20; $i++) {
            echo "<tr>";
            $hora_inicio = str_pad($i, 2, "0", STR_PAD_LEFT) . ":00";
            $hora_fin = str_pad(($i + 1), 2, "0", STR_PAD_LEFT) . ":00";
            echo "<td style='background-color: #FFFFFF; color: #118ab2; padding: 8px; text-align: center;'>$hora_inicio - $hora_fin</td>";
        
            foreach (['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'] as $dia) {
                echo "<td style='background-color: #FFFFFF; color: #118ab2; padding: 8px; text-align: center;'>";
                if (isset($horario[$dia])) {
                    foreach ($horario[$dia] as $hora) {
                        if ($i >= (int)$hora['hora_inicio'] && $i <=  (int)$hora['hora_fin'] - 1) {
                            echo '<a href="ControllerShowProfile.php?nombre=' . $hora["maestro"] . '" style="text-decoration: none; color: #218380 ;">' . $hora["maestro"] . '</a>';
                            echo " <a href='ControllerEdit.php?id=" . $hora['id'] . "' style='text-decoration: none; color: #ffd166;'>Editar</a>";
                            echo " <a href='ControllerDelete.php?id=" . $hora['id'] . "' style='text-decoration: none; color: #ef476f;'>Eliminar</a>";
                        }
                    }
                }
                echo "</td>";
            }
            echo "</tr>";
        }
        
        echo "</table>";
        
        
        
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Perfil</title>
</head>
<body>
    <style>
        
  .gradient-custom {
    /* fallback for old browsers */
    background: #f6d365;

    background: linear-gradient(to right bottom, rgba(51, 196, 255), black);
    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
  }

  .card {
    border-radius: 0.5rem;
    overflow: hidden;
  }

  .card-body {
    padding: 1.5rem;
  }

  .card h6 {
    font-weight: 500;
  }

  .card hr {
    border: 0;
    height: 1px;
    background-image: linear-gradient(to right, rgba(0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0));
  }

  .card p {
    margin-bottom: 0;
  }

  .card-img-top {
    width: 80px;
    height: 80px;
    object-fit: cover;
  }

  .social-links a {
    font-size: 1.75rem;
    margin-right: 0.5rem;
    color: #333;
    transition: color 0.2s;
  }

  .social-links a:hover {
    color: #555;
  }

    </style>
<section class="vh-100" style="background-color: black;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-lg-6 mb-4 mb-lg-0">
        <div class="card mb-3" style="border-radius: .5rem;">
          <div class="row g-0">
            <div class="col-md-4 gradient-custom text-center text-white"
              style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
              <img src="../Maestros/ImgCroquis/<?php echo $row['Imagen_croquis']; ?>" alt="Avatar" class="img-fluid my-5" style="width: 80px;" />
              <h5><?php echo $row["Nombre"] ?></h5>
              <p><?php echo $row["Apellidos"] ?></p>
              <i class="far fa-edit mb-5"></i>
            </div>
            <div class="col-md-8">
              <div class="card-body p-4">
                <h6>Información personal</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                  <div class="col-6 mb-3">
                    <h6>Email</h6>
                    <p class="text-muted"><?php echo $row["Correo"] ?></p>
                  </div>
                  <div class="col-6 mb-3">
                    <h6>Codigo UDG</h6>
                    <p class="text-muted"><?php echo $row["Codigo"] ?></p>
                  </div>
                </div>
                <h6>Projects</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                  <div class="col-6 mb-3">
                    <h6>Recent</h6>
                    <p class="text-muted">Lorem ipsum</p>
                  </div>
                  <div class="col-6 mb-3">
                    <h6>Most Viewed</h6>
                    <p class="text-muted">Dolor sit amet</p>
                  </div>
                </div>
                <div class="d-flex justify-content-start">
                  <a href="#!"><i class="fab fa-facebook-f fa-lg me-3"></i></a>
                  <a href="#!"><i class="fab fa-twitter fa-lg me-3"></i></a>
                  <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
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


    function editarRegistro($id, $nombre_laboratorio, $maestro, $hora_inicio, $hora_fin, $turno)
    {
        $database = new Database();
        $db = $database->connect();

        // Crear una instancia de la clase Horario
        // Consulta SQL para actualizar el registro en la base de datos
        $sql = "UPDATE $this->table SET nombre_laboratorio=?, maestro=?, hora_inicio=?, hora_fin=?, turno=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssssss', $nombre_laboratorio, $maestro, $hora_inicio, $hora_fin, $turno, $id);

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
 <div style="max-width: 600px; margin: 0 auto; padding: 40px; border: 1px solid #ccc; border-radius: 16px; background-color: #f9f9f9; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); font-family: 'Poppins', sans-serif;">
    <h2 style="margin-bottom: 40px; text-align: center; color: #333; font-size: 28px;">Editando</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" style="text-align: center;">
        <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">

        <div style="margin-bottom: 30px;">
            <label for="maestro" style="font-weight: bold;">Maestro:</label><br>
            <?php include "../Horarios/Componentes/Selectes.php"; mostrarOpcionesMaestrosEdicion($db, $fila['maestro']); ?>
        </div>

        <div style="margin-bottom: 30px;">
            <label for="nombre_laboratorio" style="font-weight: bold;">Nombre laboratorio:</label><br>
            <?php mostrarOpcionesLaboratoriosEdicion($db, $fila['nombre_laboratorio']); ?>
        </div>

        <div style="margin-bottom: 30px;">
            <label for="hora_inicio" style="font-weight: bold;">Hora de inicio:</label><br>
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

        <div style="margin-bottom: 30px;">
            <label for="hora_fin" style="font-weight: bold;">Hora de fin:</label><br>
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

        <div style="margin-bottom: 30px;">
            <label for="turno" style="font-weight: bold;">Turno:</label><br>
            <select name="turno" id="turno">
                <option value="Matutino">Matutino</option>
                <option value="Vespertino">Vespertino</option>
            </select>
        </div>

        <input type="submit" value="Guardar Cambios" style="padding: 14px 28px; font-size: 18px; background-color: #007bff; color: #fff; border: none; border-radius: 8px; cursor: pointer;">
    </form>
</div>


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
}
