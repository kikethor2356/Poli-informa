<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<script src="script.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Barra lateral con Submenús y Contenido</title>
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
        <li><a href="#añadirHor">Añadir Horario</a></li>
        <li><a href="#editarHor">Editar Horario</a></li>
        <li><a href="#eliminarHor">Eliminar Horario</a></li>
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
  <div id="añadirHor" class="subcontent">
    <h2>Añadir Horario</h2>
    <?php
    include "Componentes/index.php";
    include "RegisterHorario.php";
    ?>
  </div>
  <div id="editarHor" class="subcontent">
    <h2>Editar Horario</h2>
    <form action="BusquedaHorario.php"  method="POST">
    <select name="busqueda">
        <option value="Especialidades">Laboratorio de especialidades</option>
        <option value="Redes">Laboratorio de redes</option>
        <option value="Taller1">Taller1</option>
        <option value="Taller2">Taller2</option>
    </select>
    <button type="submit">Buscar</button>
</form>
  </div>
  <div id="eliminarHor" class="subcontent">
    <h2>Eliminar Horario</h2>
    <p>Este es el contenido del Producto 3.</p>
  </div>
  <div id="añadirPro" class="subcontent">
    <h2>Añadir Producto</h2>
  </div>
  <div id="buscarPro" class="subcontent">
    <h2>Buscar Producto</h2>
    <p>Este es el contenido del Servicio 2.</p>
  </div>
  <div id="eliminarPro" class="subcontent">
    <h2>Eliminar Producto</h2>
    <p>Este es el contenido del Servicio 3.</p>
  </div>
</div>

</body>
</html>
