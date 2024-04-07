<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Acercade.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Acerca de</title>
</head>
<body>
    <?php include 'Menu/MenuUsuario.html'; ?>

    <!-- Inicio del menu -->
    <section class="home">
        <div class="text">
            <!-- Contenido de todos -->
            <div class="cuerpo2">
                <h1>Acerca de POLI-INFORMA</h1>
                <div id="version">
                    <p>Versión 2.0</p>
                    <img src="Menu/imagenes/image.png" alt="Logo de POLI-INFORMA">
                </div>
        
                <div id="fondo"><br>
                    <div id="contenido">
                        <p>POLI-INFORMA un portal informativo para aquellos estudiantes que quieran conocer adetalle información sobre la escuela, como tambien a que conozca sus horarios y en que manera pueden llegar desde la entrada de la escuela asta el aula (Laboratorio, Taller o Area academica) que quiera ir o le toque en horarario de clase.</p>
                    </div>
            
                    <div id="contenido1">
                        <p>Una gran ayuda para los estudiantes que no saben que puedan vender dentro de la escuela, en este portal informativo tendra las secciones de <a href="">"Cafeteria"</a> y de <a href=""><span>"Poli-commerce"</span></a> el cual ayuda a los estudiantes que quieran vender dentro de las escuela en un horario y sepan que pueden comerte.</p>
                    </div>
            
                    <div id="contenido2">
                        <p>En terminos de avisos se tendran en tiempo y en forma para aquellos estudiantes que no encuentra toda la información, donde a su vez tendra un mapeo para que sepan donde se encuentra cada cosa o que hay en cada instalación de la escuela y como llegar.</p>
                    </div>
            
                    <div id="contenido3">
                        <p>Aqui algunas referencias por si quieres ver a más a detalle cada cosa del portal.</p>
                        <div id="referencias">
                            <a href="" class="referencia1">Preguntas frecuentes <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                            <a href="" class="referencia2">Terminos y condiciones <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                            <a href="" class="referencia3">Quejas y sugerencias <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin de su contenido -->
        <!-- Fin del menu -->
        </div>
    </section>
    


    <script>
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
    </script>
</body>
</html>