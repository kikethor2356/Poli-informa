<?php include '../../Login/inicio.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Acercade.css">
    <link rel="stylesheet" href="../Partes/footer-page/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Acerca de</title>
</head>
<body>
    <?php include '../Partes/MenuUsuario.php'; ?>
    <!-- Inicio del menu -->
    <div class="home">
        <div class="text">

            <!-- Contenido de todos -->
            <div class="contenido-1">
                <div class="sub-contenido-1">
                    <h1>Acerca de POLI-INFORMA</h1>
                    <img src="imagenes/image.png" alt="Logo de POLI-INFORMA" id="logo">
                    <p id="version">POLI-INFORMA versión 2.0</p>
                </div>
            </div>

            <div class="contenido-2">
                <div class="sub-contenido-2">
                    <p>POLI-INFORMA un portal informativo para aquellos estudiantes que quieran conocer adetalle información sobre la escuela, como tambien a que conozca sus horarios y en que manera pueden llegar desde la entrada de la escuela asta el aula (Laboratorio, Taller o Area academica) que quiera ir o le toque en horarario de clase.</p>
                    <p>Una gran ayuda para los estudiantes que no saben que puedan vender dentro de la escuela, en este portal informativo tendra las secciones de <a href="">"Cafeteria"</a> y de <a href=""><span>"Poli-commerce"</span></a> el cual ayuda a los estudiantes que quieran vender dentro de las escuela en un horario y sepan que pueden comerte.</p>
                    <p>En terminos de avisos se tendran en tiempo y en forma para aquellos estudiantes que no encuentra toda la información, donde a su vez tendra un mapeo para que sepan donde se encuentra cada cosa o que hay en cada instalación de la escuela y como llegar.</p>
                </div>
            </div>
            
            <div class="contenido-3">
                <div class="sub-contenido-3"><br>
                    <p>Para más conocimiento del portal puedes visitar estas referencias.</p><br>
                    <!-- <p>Aqui algunas referencias por si quieres ver a más a detalle cada apartado del portal.</p> -->
                    <hr>
                    <a href="" class="referencia1"><p>Preguntas frecuentes <i class="fa-solid fa-arrow-up-right-from-square open"></i></p></a>
                    <hr>
                    <a href="" class="referencia2"><p>Terminos y condiciones <i class="fa-solid fa-arrow-up-right-from-square open"></i></p></a>
                    <hr>
                    <a href="" class="referencia3"><p>Comuniación y sugerencias <i class="fa-solid fa-arrow-up-right-from-square open"></i></p></a>
                    <hr><br>
                </div>
            </div><br><br><br><br>
            <!-- Fin de su contenido -->
            
        <!-- Fin del menu -->
        </div>
    </div>

    <?php include '../Partes/footer-page/index.html';?>


    


    <!-- <script>
        const body = document.querySelector('body'),
        sidebar = body.querySelector('nav'),
        toggle = body.querySelector('.toggle'),
        searchBtn = body.querySelector('.search-box'),
        modeSwtich = body.querySelector('.toggle-switch'),
        modeText = body.querySelector('.mode-text');

        toggle.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        })

        searchBtn.addEventListener("click", () => {
            sidebar.classList.remove("close");
        })

        modeSwtich.addEventListener("click", () => {

            body.classList.toggle("dark");
            if(body.classList.contains("dark")){
                modeText.innerText = "Modo Brilloso";
            } else{
                modeText.innerText = "Modo Oscuro";
            }
        })
    </script> -->
</body>
</html>