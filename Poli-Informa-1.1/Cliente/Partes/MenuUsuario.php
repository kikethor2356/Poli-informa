<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <!-- Menu -->
    <div class="container">
        <div class="sidebar active">
            <div class="menu-btn">
                <i class="fa-solid fa-angle-right"></i>
            </div>
            <div class="heade">
                <div class="user-img">
                    <img src="../Partes/imagenes/Poli.png" alt="">
                </div>
                <div class="user-details">
                    <p class="title">Menu</p>
                    <p class="name">POLI-INFORMA</p>
                </div>
            </div>
            <div class="nav">
                <div class="menu">
                    <p class="title">Main</p>
                    <ul>
                        <li>
                            <a href="../../Cliente/Avisos/Avisos.php">
                                <i class="icon fa-solid fa-house"></i>
                                <span class="text">Avisos</span>
                            </a>
                        </li>
                        <li> <!--Menu cafeteria-->
                            <a href="#">
                                <i class="icon fa-solid fa-utensils"></i>
                                <span class="text">Cafeteria</span>
                                <i class="arrow fa-solid fa-angle-down"></i>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="../../Cliente/Cafeteria/ModuloA.php">
                                        <span class="text">Modulo-a</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="../../Cliente/Cafeteria/Canchas.php">
                                        <span class="text">Canchas</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="../../Cliente/Poli-Commerce/poli-commerce.php">
                                <i class="icon fa-solid fa-store"></i>
                                <span class="text">Poli-commerce</span>
                            </a>
                        </li>
                        <li>
                            <a href="../../Cliente/Horarios/Horarios.php">
                                <i class="icon fa-solid fa-clock"></i>
                                <span class="text">Horarios</span>
                            </a>
                        </li>
                        <!-- Menu de ayuda -->
                        <div class="menu"></div>
                        <p class="title">Ayuda</p>
                        <li> <!--Menu soporte-->
                            <a href="#">
                                <i class="icon fa-solid fa-gears"></i>
                                <span class="text">Soporte</span>
                                <i class="arrow fa-solid fa-angle-down"></i>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="../Soporte/Acercade.php">
                                        <span class="text">Acerca de</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="../Soporte/Preguntas_frecuentes.php">
                                        <span class="text">Preguntas frecuentes</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="../Soporte/ContactanosVista.php">
                                        <span class="text">Contactanos y Sugerencias</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="menu">
                <p class="title">Perfil</p>
                <ul>
                    <li>
                        <a href="../Perfil/Perfil.php">
                            <i class="icon fa-solid fa-user"></i>
                            <span class="text">Perfil</span>
                        </a>
                    </li>
                    <li>
                        <a href="../LoginU/controlador_cerrar_sesion.php">
                            <i class="icon fa-solid fa-arrow-right-from-bracket"></i>
                            <span class="text">Cerra Sesión</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Movimiento del menu -->
    <script>
        $(".menu > ul > li").click(function (e){
            // Remueve el active seleccionado segun lo que escojas
            $(this).siblings().removeClass("active")
            // añade el active seleccionad
            $(this).toggleClass("active");         
            // Si abre el sub-menu
            $(this).find("ul").slideToggle();
            //cierra la otra clase de sub-menu
            $(this).siblings().find("ul").slideUp();
            // Remueve la clase active de sub-menu items
            $(this).siblings().find("ul").find("li").removeClass("active");
        });

        $(".menu-btn").click(function (){
            $(".sidebar").toggleClass("active");
        });
    </script>

    <!-- Estilo de menu y el perfil -->
    <style>
        @import url(https://fonts.googleapis.com/css?family=Inter:100,200,300,regular,500,600,700,800,900);

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Inter", sans-serif;
        }

        :root{
            --colorPrincipal: #25a071fd;
            --colorSecundario: #C8E3D4;
            --colorTerceo: #fdfaea;
            --colorCuarto: #F6D7A7;
            --blanco: #fff;
            --negro: #000;
        }
        body {
            display: grid;
        }
        .container {
            display: flex;
            align-items: center;
            width: 100%;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 20%;
            height: 100%;
            display: flex;
            flex-direction: column;
            gap: 4%;
            background-color: var(--colorPrincipal);
            padding: 2%;
            transition: all 0.3s;

            z-index: 100;
            flex-shrink: 0; /* No permitir que el menú se reduzca*/
            border: 1px solid #000;
        }
        .sidebar .heade {
            display: flex;
            gap: 20%;
            padding-bottom: 3%;
            border-bottom: 1px solid #f6f6f6;
        }

        .icon{
            color: #000;
        }

        .text{
            color: #000;
        }

        .user-img {
            width: 59px;
            height: 59px;
            border-radius: 35%;
            overflow: hidden;
            border: 1px solid #000;
        }
        .user-img img {
            width: 100%;
            object-fit: cover;
        }
        .user-details .title,
        .menu .title {
            font-size: 12px;
            font-weight: 500; /*Letra oscura*/
            color: #000;
            text-transform: uppercase;
            margin-bottom: 5%;
        }
        .user-details .name {
            font-size: 14px;
            font-weight: 500;
            width: 100%;
        }
        .nav {
            flex: 1;
        }
        .menu ul li {
            position: relative;
            list-style: none;
            margin-bottom: 2.8px;
        }
        .menu ul li a {
            display: flex;
            align-items: center;
            gap: 10%;
            font-size: 14px;
            font-weight: 500;
            color: #757575;
            text-decoration: none;
            padding: 3px 8px;
            border-radius: 10px;
            transition: all 0.3s;
        }
        .menu ul li > a:hover,
        .menu ul li.active > a {
            color: #000;
            background-color: #f6f6f6;
        }
        .menu ul li .icon {
            font-size: 20px;
        }
        .menu ul li .text{
            flex: 1;
        }
        .menu ul li .arrow {
            font-size: 14px;
            transition: all 0.3s;
        }
        .menu ul li.active .arrow {
            transform: rotate(180deg);
        }
        .menu .sub-menu { /*Sub menu de cafeteria y soporte*/
            display: none;
            margin-left: 10%;
            padding-left: 10%;
            padding-top: 3%;
            border-left: 1px solid #f6f6f6;
        }
        .menu .sub-menu li a {
            padding: 5% 4%;
            font-size: 12px;
        }
        .menu:not(:last-child) {
            padding-bottom: 5%;
            margin-bottom: 10%;
            border-bottom: 2px solid #f6f6f6;
        }
        .menu-btn {
            position: absolute;
            right: -1%;
            top: 3.5%;
            width: 28px;
            height: 28px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #757575;
            border: 2px solid #f6f6f6;
            background-color: #fff;
        }
        .menu-btn:hover i {
            color: #000;
        }
        .menu-btn i {
            transition: all 0.3s;
        }
        .sidebar.active {
            width: 8%;
        }
        .sidebar.active .menu-btn i {
            transform: rotate(180deg);
        }
        .sidebar.active .user-details {
            display: none;
        }
        .sidebar.active .menu .title {
            text-align: center;
        }
        .sidebar.active .menu ul li .arrow {
            display: none;
        }
        .sidebar.active .menu > ul > li > a {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .sidebar.active .menu > ul > li > a .text{
            position: absolute;
            left: 70%;
            top: 50%;
            transform: translateY(-50%);
            padding: 10px;
            border-radius: 4px;
            color: #fff;
            background-color: #000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s;
        }
        .sidebar.active .menu > ul > li > a .text::after {
            content: "";
            position: absolute;
            left: -5px;
            top: 20%;
            width: 20px;
            height: 20px;
            border-radius: 2px;
            background-color: #000;
            transform: rotate(45deg);
            z-index: -1;
        }
        .sidebar.active .menu > ul > li > a:hover .text{
            left: 90%;
            opacity: 1;
            visibility: visible;
        }
        .sidebar.active .menu .sub-menu {
            position: absolute;
            top: 0;
            left: 60%;
            width: 350%;
            border-radius: 20px;
            padding: 10% 20%;
            border: 1px solid #000;
            background-color: #fff;
            box-shadow: 0px 10px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        } 

        /* Cuerpo */
        .home {
            padding-top: -1%;
            margin-left: auto;
            position: relative;
            width: 92%;
            /* border: 1px solid #000; */
            /* margin-top: 7%; */

        }

        .home .text{
            padding-top: 1%;
            position: relative;
        }

    </style>
</body>
</html>