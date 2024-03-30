<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- AGREGAR: VENTANA MODAL -->
 <div id="ModalAgregar" class="modal" >
    <!-- Contenido de la ventana modal -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <h1>Registro</h1>
        <form action="agregar_categoria.php" method="post" enctype="multipart/form-data">

            <label>Nombre de categoria</label>
            <input REQUIRED type="text" name="categoria"><br><br><br>

            <label>Elegir imagen:    </label>
            <input type="file" name="foto" id="imagenInput2" onchange="previewImage2()"><br><br><br>
            <img src="" id="imagenPreview2" width=80px height=auto><br><br><br>
            <label id="fileNameDisplay2"></label><br><br>

            <input type="submit" value="Guardar" name="Enviar1">
            <button type="submit" onclick="cerrarModal2()">Cancelar</button>

        </form>
    </div>
</div>

<!-- AGREGAR: FUNCIONES JAVASCRIPT -->
<script>
    var modal = document.getElementById("ModalAgregar");
    var closeBtn = document.getElementsByClassName("close")[0];

    function cerrarModal2() {
        modal.style.display = "none";
    }

    // Previsualizar la imagen seleccionada
    function previewImage2() {
        var preview = document.getElementById('imagenPreview2');
        var fileInput = document.getElementById('imagenInput2');
        var fileNameDisplay = document.getElementById('fileNameDisplay2');
        var file = fileInput.files[0];
        var reader = new FileReader();

        reader.onload = function () {
            preview.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);
            fileNameDisplay.textContent = file.name; // Mostrar el nombre del archivo
        } else {
            preview.src = "";
            fileNameDisplay.textContent = "No se seleccionó ningún archivo";
        }
    }

    // Obtenemos todos los botones de editar por su clase
    var modalBtns = document.querySelectorAll(".agregarM");

    // Iteramos sobre todos los botones de editar
    modalBtns.forEach(function(btn) {
        // Asignamos un evento de clic a cada botón
        btn.addEventListener("click", function() {

            // Mostramos la ventana modal
            modal.style.display = "block";

            // Si hay una foto asociada, previsualízala
            if (foto) {
                var preview = document.getElementById('imagenPreview2');
                preview.src = foto;
            }
        });
    });

    // Cuando se hace clic en el botón de cerrar, ocultamos la ventana modal
    closeBtn.onclick = function() {
        cerrarModal2();
    }
</script>

</body>
</html>