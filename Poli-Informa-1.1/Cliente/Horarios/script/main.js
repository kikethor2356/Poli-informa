document.querySelector('.a_Start').addEventListener('click', function (event) {
    event.preventDefault(); // Evitar el comportamiento predeterminado del enlace
    
    const targetId = this.getAttribute('href'); // Obtener el ID del objetivo de desplazamiento
    const targetElement = document.querySelector(targetId); // Obtener el elemento objetivo
    
    // Desplazamiento suave a la sección objetivo
    targetElement.scrollIntoView({
        behavior: 'smooth' // Opciones de desplazamiento suave
    });
});



// Obtener elementos del DOM
var modal = document.getElementById("modal");
var btnModal = document.getElementById("btnModal");
var spanClose = document.getElementsByClassName("close")[0];

// Función para mostrar la ventana modal
btnModal.onclick = function() {
  modal.style.display = "block";
}

// Función para ocultar la ventana modal
spanClose.onclick = function() {
  modal.style.display = "none";
}

// Ocultar la ventana modal cuando se haga clic fuera de ella
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}



        // Obtén el modal
        var modal = document.getElementById('modal');

        // Obtén el botón que cierra el modal
        var span = document.getElementsByClassName('close')[0];

        // Cuando el usuario hace clic en <span> (x), cierra el modal
        span.onclick = function() {
            modal.classList.add('fadeout'); // Aplica la animación de cierre
            setTimeout(function() {
                modal.style.display = 'none';
                modal.classList.remove('fadeout'); // Remueve la clase fadeout después de la animación
            }, 500); // Espera 500 milisegundos (igual a la duración de la animación)
        }

        // Cuando el usuario hace clic en cualquier lugar fuera del modal, ciérralo
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.classList.add('fadeout'); // Aplica la animación de cierre
                setTimeout(function() {
                    modal.style.display = 'none';
                    modal.classList.remove('fadeout'); // Remueve la clase fadeout después de la animación
                }, 500); // Espera 500 milisegundos (igual a la duración de la animación)
            }
        }
