document.querySelector('.a_Start').addEventListener('click', function (event) {
    event.preventDefault(); // Evitar el comportamiento predeterminado del enlace
    
    const targetId = this.getAttribute('href'); // Obtener el ID del objetivo de desplazamiento
    const targetElement = document.querySelector(targetId); // Obtener el elemento objetivo
    
    // Desplazamiento suave a la sección objetivo
    targetElement.scrollIntoView({
        behavior: 'smooth' // Opciones de desplazamiento suave
    });
});
