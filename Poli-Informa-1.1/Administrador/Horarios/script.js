document.addEventListener("DOMContentLoaded", function() {
    var submenuItems = document.querySelectorAll('.submenu');

    submenuItems.forEach(function(item) {
      item.addEventListener('click', function() {
        item.classList.toggle('active');
      });
    });

    var subcontentLinks = document.querySelectorAll('.submenu a');

    subcontentLinks.forEach(function(link) {
      link.addEventListener('click', function(event) {
        event.preventDefault();
        var targetId = link.getAttribute('href').substring(1);
        var targetContent = document.getElementById(targetId);
        var allContent = document.querySelectorAll('.subcontent');

        allContent.forEach(function(content) {
          content.classList.remove('active');
        });

        targetContent.classList.add('active');
      });
    });
  });

  
    function eliminarRegistro(id) {
        // Realizar la solicitud AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "ruta_al_tu_script_eliminar.php?id=" + id, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Manejar la respuesta del servidor
                var respuesta = xhr.responseText;
                alert(respuesta); // Mostrar un mensaje de alerta con la respuesta del servidor
                // Actualizar la interfaz de usuario si es necesario
                // Por ejemplo, ocultar el registro eliminado
                location.reload(); // Recargar la página para reflejar los cambios en la interfaz de usuario
            }
        };
        xhr.send();
    }