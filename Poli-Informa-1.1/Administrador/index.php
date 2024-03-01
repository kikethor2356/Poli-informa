<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard con Barra Lateral Izquierda</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Estilos adicionales */
    .sidebar {
      height: 100%;
      width: 250px;
      position: fixed;
      top: 0;
      left: 0;
      background-color: #333;
      padding-top: 60px;
    }
    .sidebar a {
      padding: 10px 20px;
      text-decoration: none;
      font-size: 18px;
      color: #ddd;
      display: block;
      transition: all 0.3s ease;
    }
    .sidebar a:hover {
      background-color: #555;
    }
    .sidebar .sub-menu {
      padding-left: 20px;
      display: none;
    }
    .content {
      margin-left: 250px;
      padding: 20px;
    }
    .content h2 {
      color: #333;
      margin-bottom: 20px;
    }
    .content p {
      color: #666;
    }
  </style>
</head>
<body>

<!-- Barra lateral -->
<div class="sidebar">
  <h2 class="text-white">Barra Lateral</h2>
  <a href="#" class="has-submenu" data-content="contenido1">Inicio</a>
  <div class="sub-menu">
    <a href="#" data-content="subcontenido1">Submenú 1</a>
    <a href="#" data-content="subcontenido2">Submenú 2</a>
  </div>
  <a href="#" class="has-submenu" data-content="contenido2">Dashboard</a>
  <div class="sub-menu">
    <a href="#" data-content="subcontenido3">Submenú 3</a>
    <a href="#" data-content="subcontenido4">Submenú 4</a>
  </div>
  <a href="#" class="has-submenu" data-content="contenido3">Usuarios</a>
  <div class="sub-menu">
    <a href="#" data-content="subcontenido5">Submenú 5</a>
    <a href="#" data-content="subcontenido6">Submenú 6</a>
  </div>
  <a href="#" class="has-submenu" data-content="contenido4">Configuración</a>
  <div class="sub-menu">
    <a href="#" data-content="subcontenido7">Submenú 7</a>
    <a href="#" data-content="subcontenido8">Submenú 8</a>
  </div>
</div>

<!-- Contenido principal -->
<div class="content" id="main-content">
  <!-- Contenido se cargará aquí -->
</div>

<!-- Scripts de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script>
  // Mostrar contenido al hacer clic en los submenús
  document.addEventListener('DOMContentLoaded', function() {
    const submenuLinks = document.querySelectorAll('.has-submenu');
    const contentContainer = document.getElementById('main-content');
    
    submenuLinks.forEach(link => {
      link.addEventListener('click', function(event) {
        event.preventDefault();
        const contentId = this.getAttribute('data-content');
        const content = document.getElementById(contentId).innerHTML;
        contentContainer.innerHTML = content;

        // Guardar la última selección en localStorage
        localStorage.setItem('lastSelected', contentId);
      });
    });

    // Recuperar la última selección al cargar la página
    const lastSelected = localStorage.getItem('lastSelected');
    if (lastSelected) {
      const selectedLink = document.querySelector(`[data-content="${lastSelected}"]`);
      if (selectedLink) {
        selectedLink.click();
      }
    }
  });
</script>

<!-- Contenidos ocultos -->
<div id="contenido1" style="display: none;">
  <h2>Contenido de Inicio</h2>
  <p>Este es el contenido de la página de inicio.</p>
</div>

<div id="subcontenido1" style="display: none;">
  <h2>Contenido de Submenú 1</h2>
  <p>Este es el contenido del primer submenú.</p>
</div>

<div id="subcontenido2" style="display: none;">
  <h2>Contenido de Submenú 2</h2>
  <p>Este es el contenido del segundo submenú.</p>
</div>

<div id="contenido2" style="display: none;">
  <h2>Contenido de Dashboard</h2>
  <p>Este es el contenido de la página de dashboard.</p>
</div>

<div id="subcontenido3" style="display: none;">
  <h2>Contenido de Submenú 3</h2>
  <p>Este es el contenido del tercer submenú.</p>
</div>

<div id="subcontenido4" style="display: none;">
  <h2>Contenido de Submenú 4</h2>
  <p>Este es el contenido del cuarto submenú.</p>
</div>

<div id="contenido3" style="display: none;">
  <h2>Contenido de Usuarios</h2>
  <p>Este es el contenido de la página de usuarios.</p>
</div>

<div id="subcontenido5" style="display: none;">
  <h2>Contenido de Submenú 5</h2>
  <p>Este es el contenido del quinto submenú.</p>
</div>

<div id="subcontenido6" style="display: none;">
  <h2>Contenido de Submenú 6</h2>
  <p>Este es el contenido del sexto submenú.</p>
</div>

<div id="contenido4" style="display: none;">
  <h2>Contenido de Configuración</h2>
  <p>Este es el contenido de la página de configuración.</p>
</div>

<div id="subcontenido7" style="display: none;">
  <h2>Contenido de Submenú 7</h2>
  <p>Este es el contenido del séptimo submenú.</p>
</div>

<div id="subcontenido8" style="display: none;">
  <h2>Contenido de Submenú 8</h2>
  <p>Este es el contenido del octavo submenú.</p>
</div>
</body>
</html>
