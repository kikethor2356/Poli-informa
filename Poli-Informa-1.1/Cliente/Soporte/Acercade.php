<?php include '../LoginU/inicio.php'; ?>
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
        <!-- <div class="text"> -->
            <!-- Contenido de todos -->
            <header class="cabecera">
                <img class="cabecera__imagen"  src="imagenes/Acercade.jpg" alt="imagen terminos y condiciones">
                <div class="cabecera__hero">
                    <h1 class="cabecera__titulo">Acerca de POLI-INFORMA</h1>
                </div>
            </header>

            <main class="contenedor">
                <div class="acercade">
                    <div class="acercade_informacion">
                        <h2 class="acercade_subtitulo">Acerca de POLI-INFORMA</h2>
                        <!-- <img src="imagenes/image.png" alt="Logo de POLI-INFORMA" id="logo"> -->
                        <p>POLI-INFORMA versión 2.0</p>
                        <p>Hablemos un poco de POLI-INFORMA, es un portal que ayuda a los estudiantes de la Escuela Politecnica de Guadalajara a que conoscan un poco más sobre la escuela, independiente si eres de nuevo ingreso o que estes dentro de la escuela.</p>
                        <p>En este portal conoceras a detalle lo que puedes hacer y en que te puede ayudar.</p>
                    </div><br>

                    <div class="acercade_informacion">
                        <h2 class="acercade_subtitulo">¿Qué es?</h2>
                        <p>POLI-INFORMA es un portal informativo para quellos estudiantes que quieran conocer un poco más sobre su escuela, ya que este portal puede ver datos muy importantes en la sessión de <a href="../Avisos/Avisos.php">Avisos</a> podras ver la información importante ya sea desde becas o dias de descanso o cuando son eventos importante.</p>
                        <p>Tambien en este portal podras ver lo que los horarios de los laboratorios, talleres o areas academicas, tambien puedes interactuar con las sessiones <a href="../Cafeteria/ModuloA.php">Cafeteria</a> y <a href="../Poli-Commerce/index.php">Poli-Commerce</a> hay podras ver productos que estan disponibles en la escuela, en "Cafeteria" hay dos sessiones las cuales podra tener diferentes productos o en "Poli-Commerce" el caul podras ver productos que vende los estudiantes de la escuela.</p><br>
    
                        <!-- <p>POLI-INFORMA un portal informativo para aquellos estudiantes que quieran conocer adetalle información sobre la escuela, como tambien a que conozca sus horarios y en que manera pueden llegar desde la entrada de la escuela asta el aula (Laboratorio, Taller o Area academica) que quiera ir o le toque en horarario de clase.</p><br> -->
                        <h3>¿Ayuda?</h3>
                        <p>Una gran ayuda para los estudiantes que no saben que puedan vender dentro de la escuela en la sessión <a href="../Poli-Commerce/index.php"><span>"Poli-commerce"</span></a> el cual ayuda a los estudiantes que quieran vender dentro de las escuela en un horario y sepan que pueden comerte.<br>
                        Tambien puedes ver los horarios y podras ver un mapeo dentro de la escuela de como llegar al igual que al inicio de la página abajo de avisos podras ver un mapeo de la escuela en como llegar o como se ve el area por medio de un croquis.</p><br>
                    </div><br>
                
                    <div class="acercade_informacion">
                        <h2 class="acercade_subtitulo">Más información</h2>
                        <p>Para conocer más de POLI-INFORMA puedes navegar en las siguientes referencias</p><br>
                        <!-- <p>Aqui algunas referencias por si quieres ver a más a detalle cada apartado del portal.</p> -->
                        <div class="ref">
                            <a href="../Soporte/Preguntas_frecuentes.php" class="referencia1"><p>Preguntas frecuentes <i class="fa-solid fa-arrow-up-right-from-square open"></i></p></a>
                            <hr>
                            <a href="../Soporte/Terminos_Condiciones.php" class="referencia2"><p>Terminos y condiciones <i class="fa-solid fa-arrow-up-right-from-square open"></i></p></a>
                            <hr>
                            <a href="../Soporte/ContactanosVista.php" class="referencia3"><p>Comuniación y sugerencias <i class="fa-solid fa-arrow-up-right-from-square open"></i></p></a>
                        </div>
                        <br>
                    </div>
                </div>
            </main>
            <!-- Fin de su contenido -->
            
        <!-- Fin del menu -->
        <!-- </div> -->
    </div>

    <?php include '../Partes/footer.php';?>
</body>
</html>