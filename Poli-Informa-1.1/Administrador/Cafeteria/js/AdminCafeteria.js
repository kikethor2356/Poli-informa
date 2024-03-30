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


// Función para mostrar la ventana emergente
function mostrarVentana() {
    let abrir = document.querySelector('.nuevoProducto');
    let modal = document.querySelector('.ventanaEmergente');
    let cerrar = document.querySelector('.ventanacerrar');
    let cerrar2 = document.querySelector('.cerrar-ventanaAgregar');
    abrir.addEventListener("click", ()=>{
        modal.classList.add('enseñar_modal');
    });
    cerrar.addEventListener("click", ()=>{
        modal.classList.remove('enseñar_modal');
    });
    cerrar2.addEventListener("click", ()=>{
        modal.classList.remove('enseñar_modal');
    });
}
// Función para borrar los datos cuando se presiona el botón "Cancelar"
function limpiarDatos() {
    document.getElementById('nombre').value = "";
    document.getElementById('descripcion').value = "";
    document.getElementById('precio').value = "";
    document.getElementById('categoria_nombre').selectedIndex = 0;
    document.getElementById('imagenInput').value = "";
    document.getElementById('imagenPreview').src = "";
    document.getElementById('nombreArchivo').value = "";
}
window.onload = mostrarVentana;
// Fin de la funcion de agregar


// Ventana de Editar producto
// Función para abrir la ventana emergente de edición
function abrirVentanaEditar(id, nombre, descripcion, precio, imagen, categoria, categoria_id, nombre_imagen) {
    // Para mostrar ventana
    let abrir = event.target; // Selecciona el botón que se ha hecho clic
    let modal = document.querySelector('.ventanaEditarProducto');
    let cerrar = document.querySelector('.ventanacerrarEditar');
    let cerrarr2 = document.querySelector('.cerrar-ventanaEditar');
    modal.classList.add('enseñar_Editar'); // Agrega la clase para mostrar la ventana

    // Datos para editar
    var idInput = document.getElementById("cafeteriamaid");
    var nombreInput = document.getElementById("nombre_producto1");
    var descripcionInput = document.getElementById("descripcion1");
    var precioInput = document.getElementById("precio1");
    var imagenOldInput = document.getElementById("imagen_old");
    var categoriaInput = document.getElementById("categoria_nombre1");
    var imagenPreview = document.getElementById('imagenPreviewEditar');

    // Actualiza los valores de los campos de entrada con los datos del registro seleccionado
    idInput.value = id;
    nombreInput.value = nombre;
    descripcionInput.value = descripcion;
    precioInput.value = precio;
    imagenOldInput.value = imagen;
    categoriaInput.value = categoria_id; // Esto seleccionará la categoría correspondiente en el formulario de edición.

    // Elimina el atributo readonly de los campos de entrada
    nombreInput.removeAttribute('readonly');
    descripcionInput.removeAttribute('readonly');
    precioInput.removeAttribute('readonly');
    imagenOldInput.removeAttribute('readonly');

    if (imagen) {
        imagenPreview.src = "Agregar/temp/" + imagen;
    } else {
        imagenPreview.src = "";
    }

    // Establecer el valor del campo de entrada de imagen en blanco para que no muestre la imagen anterior
    document.getElementById('imagenInputEditar').value = '';

    // Llama a previewImageEditar con el nombre de la imagen
    previewImageEditar(nombre_imagen);
}
function previewImageEditar(input) {
    var filenameInput = document.getElementById('nombreArchivoEditar');
    var file;

    if (input instanceof File) {
        file = input;
        filenameInput.value = file.name;
    } else {
        filenameInput.value = input;
        var files = input.files;
        if (files.length > 0) {
            file = files[0];
        } else {
            filenameInput.value = "";
            return;
        }
    }

    filenameInput.value = file.name;

    var reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('imagenPreviewEditar').src = e.target.result;
    };

    reader.readAsDataURL(file);
}
function cerrarVentanaEditar() {
    document.querySelector(".ventanaEditarProducto").classList.remove('enseñar_Editar'); // Oculta la ventana de edición
    document.querySelector(".cerrar-ventanaEditar").classList.remove('enseñar_Editar'); // Oculta la ventana de edición
}


// Ventana para Ver producto
function abrirVentanaVisualizar(nombre, descripcion, precio, imagen, categoria) {
    let modal = document.getElementById('ventanaVisualizarProducto'); // Obtenemos la ventana por su ID único
    modal.classList.add('enseñar_Ver'); // Agrega la clase para mostrar la ventana

    var nombreProducto = document.getElementById("nombreProducto");
    var descripcionProducto = document.getElementById("descripcionProducto");
    var precioProducto = document.getElementById("precioProducto");
    var categoriaProducto = document.getElementById("categoriaProducto");
    var imagenProducto = document.getElementById("imagenProducto");

    nombreProducto.textContent = "Nombre: " + nombre;
    descripcionProducto.textContent = "Descripción: " + descripcion;
    precioProducto.textContent = "Precio: " + precio;
    categoriaProducto.textContent = "Categoría: " + categoria;
    imagenProducto.src = "Agregar/temp/" + imagen;
}
function cerrarVentanaVisualizar() {
    let modal = document.getElementById('ventanaVisualizarProducto'); // Obtenemos la ventana por su ID único
    modal.classList.remove('enseñar_Ver'); // Removemos la clase para ocultar la ventana
    let modal1 = document.getElementById('ventana-cerrar3'); // Obtenemos la ventana por su ID único
    modal1.classList.remove('enseñar_Ver'); // Removemos la clase para ocultar la ventana
}


// Mostrara la imagen cuando la Agregar y cuando lo Edites
// Función para mostrar la imagen seleccionada y su nombre
function previewImage() {
    var preview = document.getElementById('imagenPreview');
    var file = document.getElementById('imagenInput').files[0];
    var reader = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
    }

    if (file) {
        reader.readAsDataURL(file);
        // Mostrar el nombre del archivo
        document.getElementById('nombreArchivo').value = file.name;
    } else {
        preview.src = "";
        // Borrar el nombre del archivo si no se selecciona ninguna imagen
        document.getElementById('nombreArchivo').value = "";
    }
}
