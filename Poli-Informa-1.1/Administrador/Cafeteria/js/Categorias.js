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
function cerrarVentanaError() {
    document.querySelector('.contenedor-error').style.display = 'none';
}


// Función para mostrar la ventana emergente
function mostrarVentana() {
    let abrir = document.querySelector('.nuevoProducto');
    let modal = document.querySelector('.ventanaEmergenteCategoria');
    let cerrar = document.querySelector('.ventanacerrarCategoria');
    let cerrar2 = document.querySelector('.cerrar-ventanaAgregarCate');
    abrir.addEventListener("click", ()=>{
        modal.classList.add('enseñar_modalCategoria');
    });
    cerrar.addEventListener("click", ()=>{
        modal.classList.remove('enseñar_modalCategoria');
    });
    cerrar2.addEventListener("click", ()=>{
        modal.classList.remove('enseñar_modalCategoria');
    });
}
// Función para borrar los datos cuando se presiona el botón "Cancelar"
function limpiarDatos() {
    document.getElementById('categoria_nombre').value = "";
}
window.onload = mostrarVentana;


// Ventana de Editar producto
// Función para abrir la ventana emergente de edición
function abrirVentanaEditar(id, nombre) {
    // Para mostrar ventana
    let abrir = event.target; // Selecciona el botón que se ha hecho clic
    let modal = document.querySelector('.ventanaEditarProductoCategoria');
    let cerrar = document.querySelector('.ventanacerrarEditarCategoria');
    modal.classList.add('enseñar_EditarCategoria'); // Agrega la clase para mostrar la ventana

    // Datos para editar
    var idInput = document.getElementById("categoria_id");
    var nombreInput = document.getElementById("categoria_nombre");

    // Actualiza los valores de los campos de entrada con los datos del registro seleccionado
    idInput.value = id;
    nombreInput.value = nombre;

    // Elimina el atributo readonly de los campos de entrada
    nombreInput.removeAttribute('readonly');
}
function cerrarVentanaEditar() {
    document.querySelector(".ventanaEditarProductoCategoria").classList.remove('enseñar_EditarCategoria'); // Oculta la ventana de edición
    document.querySelector(".cerrar-ventanaEditarCategoria").classList.remove('enseñar_EditarCategoria'); // Oculta la ventana de edición   
}
