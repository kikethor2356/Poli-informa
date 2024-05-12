//Permite que solo pueda ingresar numeros en el codigo de estudiante

document.getElementById('soloNumeros').addEventListener('input', function(e) {
    //replaza todo los caracteres por nada
     this.value = this.value.replace(/[^0-9]/g, '');
});

//Valida que en nombre y apellidos solo puedan letras
function validarInput(event) {
    var codigo = event.which || event.keyCode;
        //permitir teclas de control como retroceso, tabulalación, etc.
        if (codigo == 8 || codigo == 9 || codigo == 37 || codigo == 39){
            return true;
        }
        var caracter = String.fromCharCode(codigo);
        var patron = /[a-zA-Z]/; //esta expresion permite regular solo letras
        if (!patron.test(caracter)) {
            event.preventDefault();
            return false;
        }
    }

//se encarga de que la contraeña cumpla con lo establecido
function validarPassword(){
    var password = document.getElementById("password").value;
    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,9}$/;

    if (regex.test(password)){
        
    } else {
        window.alert("La contraseña no cumple no cumple con los requisitos: De 6-9 caracteres, 1 letra mayúscula y 1 número");
    }
}

function mostrarEditar(id, codigo, nombre, apellidoPaterno, apellidoMaterno, carrera, correo, imagen, contraseña, nombre_imagen){
    // Abrir ventana modal
    let abrir = event.target; 
    let modal = document.querySelector('.modal_editar');
    let abrirModal = document.getElementById(`abrirModal_${codigo}`);
    let cerrarModal = document.querySelector('.cerrarModal');
    modal.classList.add('modal-mostrar-editar');

    let idUsuario = document.getElementById('idUsuario');
    let codigoUsuario = document.getElementById('soloNumeros');
    let nombresUsuario = document.getElementById('campoNombre');
    let apellidoPaternoUsuario = document.getElementById('campoApellidoPaterno');
    let apellidoMaternoUsuario = document.getElementById('campoApellidoMaterno');
    let carreraUsuario = document.getElementById('campoCarrera');
    let correoUsuario = document.getElementById('campoCorreo');
    var imagenOldInput = document.getElementById("AluImagen_old");
    let passwordUsuario = document.getElementById('password');
    var imagenPreview = document.getElementById('imagenPreviewEditar');

    idUsuario.value = id;
    codigoUsuario.value = codigo;
    nombresUsuario.value = nombre;
    apellidoPaternoUsuario.value = apellidoPaterno;
    apellidoMaternoUsuario.value = apellidoMaterno;
    carreraUsuario.value = carrera;
    correoUsuario.value = correo;
    imagenOldInput.value = imagen;
    passwordUsuario.value = contraseña;

    // Establecer la imagen previa
    if (imagen) {
        imagenPreview.src = "imagenes1/" + imagen;
    } else {
        imagenPreview.src = "";
    }

    // Establecer el valor del campo de entrada de imagen en blanco para que no muestre la imagen anterior
    document.getElementById('imagenInputEditar').value = '';

    // Eliminar los atributos readonly después de establecer los valores de los campos
    nombresUsuario.removeAttribute('readonly');
    apellidoPaternoUsuario.removeAttribute('readonly');
    apellidoMaternoUsuario.removeAttribute('readonly');
    carreraUsuario.removeAttribute('readonly');
    correoUsuario.removeAttribute('readonly');
    imagenOldInput.removeAttribute('readonly');
    passwordUsuario.removeAttribute('readonly');

    if (imagen) {
        imagenPreview.src = "imagenes1/" + imagen;
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
        var files = input.files;modal_editar
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
    document.querySelector(".modal_editar").classList.remove('modal-mostrar-editar'); // Oculta la ventana de edición
}

// modal_abrir_editar_producto_${id}`



function mostrarBorrar(id){

    let idEliminar = document.getElementById('idEliminar');
    idEliminar.value = id;

}




// if($metodoAccion == 2){

//     $idProducto = (int) filter_var($_POST['idEditarProducto'], FILTER_SANITIZE_NUMBER_INT);
//     $nombreProducto = filter_var($_POST['nombreEditarProducto'], FILTER_SANITIZE_STRING);
//     $codigoVendedor = filter_var($_POST['vendedorEditarProducto'], FILTER_SANITIZE_STRING);
//     $precioProducto = filter_var($_POST['precioEditarProducto'], FILTER_VALIDATE_FLOAT);
//     $descripcionProducto = filter_var($_POST['descripcionEditarProducto'], FILTER_SANITIZE_STRING);
//     $nombreImagenProducto = filter_var($_POST['rutaArchivoEditarProducto'], FILTER_SANITIZE_STRING);
//     $categoriaProducto = filter_var($_POST['comboBoxCategoriaEditarProducto'], FILTER_SANITIZE_STRING);

//     $updateProducto = ("UPDATE productos 
//     set nombre='$nombreProducto',
//     codigoVendedor='$codigoVendedor',
//     precio='$precioProducto',
//     descripcion='$descripcionProducto',
//     nombreImagen='$nombreImagenProducto',
//     categoria='$categoriaProducto'
//     WHERE id='$idProducto' ");

//     $resultadoUpdate = mysqli_query($conexion, $updateProducto);

//     if(!empty($_FILES['archivoEditarProducto']['name'])){
        
//         $nombreFoto = $_FILES['archivoEditarProducto']['name'];
//         $temporal = $_FILES['archivoEditarProducto']['tmp_name'];

//         $carpeta = 'imagenes1';
//         $miCarpeta = opendir($carpeta);
//         $urlFoto = $carpeta. '/' .$nombreFoto;

//         if(move_uploaded_file($temporal, $urlFoto)){

//             $updateFoto = ("UPDATE productos set nombreImagen='$nombreFoto' WHERE id='$idProducto' ");
//             $resultUpdate = mysqli_query($conexion, $updateFoto);

//         }

//     }

//     header("Location: ../index.php");

// }//FIN METODOACCIÓN 2

