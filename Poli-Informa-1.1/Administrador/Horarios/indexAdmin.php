<?php
include "../../Conexion/conexion.php";
include "Componentes/ComboBoxMaestros.php";
$database = new Database();
$db = $database->connect();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <script src="script.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Poli-Informa Admin</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    .sidebar {
      height: 100%;
      width: 250px;
      position: fixed;
      top: 0;
      right: 0;
      background-color: #333;
      padding-top: 20px;
      color: white;
    }

    .sidebar ul {
      list-style-type: none;
      padding: 0;
      margin: 0;
    }

    .sidebar ul li {
      padding: 10px;
    }

    .sidebar ul li a {
      display: block;
      color: white;
      text-decoration: none;
    }

    .submenu ul {
      display: none;
      padding-left: 20px;
    }

    .submenu.active ul {
      display: block;
    }

    .content {
      margin-left: 250px;
      padding: 20px;
    }

    .content>div {
      display: none;
    }

    .content>div.active {
      display: block;
    }
  </style>
</head>

<body>

  <div class="sidebar">
    <ul>
      <li><a href="#">Inicio</a></li>
      <li class="submenu"><a href="#">Horario</a>
        <ul>
          <li><a href="#añadirHor">Añadir</a></li>
          <li><a href="#editarHor">Editar o Eliminar</a></li>
        </ul>
      </li>
     
      <li><a href="#">Contacto</a></li>
    </ul>
  </div>

  <div class="content">
    <div id="añadirHor" class="subcontent">
      <h2>Añadir Horario</h2>
      <form action="ControllerSearch.php" method="POST">
        <?php
        mostrarOpcionesLaboratorios($db);
        ?>
        <button type="submit">Buscar</button>
      </form> 



</body>

</html>