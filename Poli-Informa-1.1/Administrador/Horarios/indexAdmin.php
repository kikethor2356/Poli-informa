<?php 
include "Componentes/ComboBoxMaestros.php";
$database = new Database();
$conn = $database->connect();
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

  .content > div {
    display: none;
  }

  .content > div.active {
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
    <li class="submenu"><a href="#">Producto</a>
      <ul>
        <li><a href="#añadirPro">Añadir Producto</a></li>
        <li><a href="#buscarPro">Buscar Producto</a></li>
        <li><a href="#eliminarPro">Eliminar Producto</a></li>
      </ul>
    </li>
    <li><a href="#">Contacto</a></li>
  </ul>
</div>

<div class="content">
  <!-- Contenido de los submenús -->

  <div id="editarHor" class="subcontent">
    <h2>Editar o Eliminar Horario</h2>
    <form action="ControllerSearch.php"  method="POST">
    <?php
    mostrarOpcionesLaboratorios($conn);
    ?>
      <button type="submit">Buscar</button>
</div>
</form>

  <div id="añadirHor" class="subcontent">
    <h2>Añadir Horario</h2>

<!-- Formulario HTML en index.php -->
<form action="ControllerCreate.php" method="post">
    <?php
    mostrarOpcionesMaestros($conn);
    mostrarOpcionesLaboratorios($conn);
    ?>
   
    <select name="hora_inicio" id="hora_inicio">
        <option value="7:00 am">7:00am</option>
        <option value="8:00 am">8:00am</option>
        <option value="9:00 am">9:00am</option>
        <option value="10:00 am">10:00am</option>
        <option value="11:00 am">12:00am</option>
        <option value="12:00 pm">12:00pm</option>
        <option value="1:00 pm">1:00pm</option>
        <option value="2:00 pm">2:00pm</option>
        <option value="3:00 pm">3:00pm</option>
        <option value="4:00 pm">4:00pm</option>
        <option value="5:00 pm">5:00pm</option>
        <option value="6:00 pm">6:00pm</option>
        <option value="7:00 pm">7:00pm</option>
        <option value="8:00 pm">8:00pm</option>
    </select>
   <select name="hora_fin" id="hora_fin">
        <option value="8:00 am">8:00am</option>
        <option value="9:00 am">9:00am</option>
        <option value="10:00 am">10:00am</option>
        <option value="11:00 am">12:00am</option>
        <option value="12:00 pm">12:00pm</option>
        <option value="1:00 pm">1:00pm</option>
        <option value="2:00 pm">2:00pm</option>
        <option value="3:00 pm">3:00pm</option>
        <option value="4:00 pm">4:00pm</option>
        <option value="5:00 pm">5:00pm</option>
        <option value="6:00 pm">6:00pm</option>
        <option value="7:00 pm">7:00pm</option>
        <option value="8:00 pm">8:00pm</option>
   </select>
   <select name="dias" id="dia_semana">
        <option value="Lunes">Lunes</option>
        <option value="Martes">Martes</option>
        <option value="Miercoles">Miercoles</option>
        <option value="Jueves">Jueves</option>
        <option value="Lunes">Viernes</option>
        <option value="Lunes">Sabado</option>
   </select>
    <input type="submit" name="submit" value="Guardar">
</form>
    <?php
    include "ControllerCreate.php";
    ?>
  </div>


</body>
</html>
