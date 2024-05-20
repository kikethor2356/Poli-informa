// Para eliminar el producto
// Función para mostrar la ventana de confirmación al eliminar un producto
function mostrarConfirmacion(id) {
    let modal = document.querySelector('.contenedor-modal');
    let confirmarBtn = document.querySelector('.confirmarBtn');
    let cancelarBtn = document.querySelector('.cancelarBtn');

    // Mostrar el modal
    modal.classList.add('mostrar-modal');

    // Configurar el evento para cerrar el modal al hacer clic en Cancelar
    cancelarBtn.addEventListener("click", function() {
        modal.classList.remove('mostrar-modal');
    });

    // Configurar el evento para enviar el formulario al hacer clic en Confirmar
    confirmarBtn.addEventListener("click", function(event) {
        console.log("Eliminar el producto con ID:", id);
        modal.classList.remove('mostrar-modal');
        event.preventDefault();
        document.getElementById('eliminarForm_' + id).submit();
    });    
}
function cerrarVentanaEliminar() {
    let modal = document.querySelector(".contenedor-modal");
    modal.classList.remove('mostrar-modal');
}
// Fin de funcion de eliminar

// Ventana para Ver producto
function abrirVentanaVisualizar(nombre, correo, comentario) {
    let modal = document.getElementById('ventanaVisualizarComentario'); // Obtenemos la ventana por su ID único
    modal.classList.add('enseñar_Ver'); // Agrega la clase para mostrar la ventana

    var nombrecomebtario = document.getElementById("UsNombre");
    var correocomentario = document.getElementById("UsCorreo");
    var comenatrioc = document.getElementById("UsComentario");

    nombrecomebtario.textContent = "Nombre: " + nombre;
    correocomentario.textContent = "Correo: " + correo;
    comenatrioc.textContent = "Descripción: " + comentario;
}
function cerrarVentanaVisualizar() {
    let modal = document.getElementById('ventanaVisualizarComentario'); // Obtenemos la ventana por su ID único
    modal.classList.remove('enseñar_Ver'); // Removemos la clase para ocultar la ventana
    let modal1 = document.getElementById('cerrar-ventanaMostrar'); // Obtenemos la ventana por su ID único
    modal1.classList.remove('enseñar_Ver'); // Removemos la clase para ocultar la ventana
}