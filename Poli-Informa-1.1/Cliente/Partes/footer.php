<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Footer - Sagar Developer</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
 
    <footer class="footer-distributed">

        <div class="footer-left">
            <h3>Poli<span>Informa  </span></h3>


            <p class="footer-links">
                <a href="../Avisos/Avisos.php">Inicio</a>
                |
                <a href="../Soporte/Acercade.php">Acerca de</a>
                |
                <a href="../Soporte/Terminos_Condiciones.php">Terminos y condiciones</a>
                
            </p>

            <p class="footer-company-name">Copyright © 2024 <strong>Poli-Informa</strong> Todos los derechos recervados</p>
        </div>

        <div class="footer-center">
            <div>
                <i class="fa fa-map-marker"></i>
                <p><span>Jalisco</span>
                    Guadalajara</p>
            </div>

            <div>
                <i class="fa fa-phone"></i>
                <p>+52 33 267 77 713</p>
            </div>
            <div>
                <i class="fa fa-envelope"></i>
                <p><a href="mailto:sagar00001.co@gmail.com">poli-informa@gmail.com</a></p>
            </div>
        </div>
        <div class="footer-right">
            <p class="footer-company-about">
                <span>Acerca de Poli-Informa</span>
                <strong>Poli-Informa</strong> es un sitio en donde puedes consultar informacion de el politecnico 
                puedes encontar desde los avisos, menus de coperativas, horarios de laboratorios, talleres y mucho mas en <strong>Poli-Informa</strong>
            </p>
            <div class="footer-icons">
                <a href="https://www.facebook.com/politecnica.sems.udg.mx"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="https://www.youtube.com/@escuelapolitecnicadeguadal68"><i class="fa fa-youtube"></i></a>
            </div>
        </div>
    </footer>

    <style>
        @import url('http://fonts.googleapis.com/css?family=Open+Sans:400,700');

        /* The footer is fixed to the bottom of the page */

        footer {
            position: relative;
        }

        .footer-distributed {

            background-color: #2d2a30;
            box-sizing: border-box;
            width: 100%;
            text-align: left;
            font: bold 16px sans-serif;
            padding: 50px 50px 60px 50px;
            /* margin-top: 80vh; */
        }

        .footer-distributed .footer-left, .footer-distributed .footer-center, .footer-distributed .footer-right {
            display: inline-block;
            vertical-align: top;
        }

        /* Footer left */

        .footer-distributed .footer-left {
            margin-left: 10%;
            width: 25%;
        }

        .footer-distributed h3 {
            color: #ffffff;
            font: normal 36px 'Cookie', cursive;
            margin: 0;
        }


        .footer-distributed h3 span {
            color: #e0ac1c;
        }

        /* Footer links */

        .footer-distributed .footer-links {
            color: #ffffff;
            margin: 20px 0 12px;
        }

        .footer-distributed .footer-links a {
            display: inline-block;
            line-height: 1.8;
            text-decoration: none;
            color: inherit;
        }

        .footer-distributed .footer-company-name {
            color: #8f9296;
            font-size: 14px;
            font-weight: normal;
            margin: 0;
        }

        /* Footer Center */

        .footer-distributed .footer-center {
            margin-left: 8%;
            width: 30%;
        }

        .footer-distributed .footer-center i {
            background-color: #33383b;
            color: #ffffff;
            font-size: 25px;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            text-align: center;
            line-height: 42px;
            margin: 10px 15px;
            vertical-align: middle;
        }

        .footer-distributed .footer-center i.fa-envelope {
            font-size: 17px;
            line-height: 38px;
        }

        .footer-distributed .footer-center p {
            display: inline-block;
            color: #ffffff;
            vertical-align: middle;
            margin: 0;
        }

        .footer-distributed .footer-center p span {
            display: block;
            font-weight: normal;
            font-size: 14px;
            line-height: 2;
        }

        .footer-distributed .footer-center p a {
            color: #e0ac1c;
            text-decoration: none;
            ;
        }

        /* Footer Right */

        .footer-distributed .footer-right {
            
            width: 25%;
        }

        .footer-distributed .footer-company-about {
            line-height: 20px;
            color: #92999f;
            font-size: 13px;
            font-weight: normal;
            margin: 0;
        }

        .footer-distributed .footer-company-about span {
            display: block;
            color: #ffffff;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .footer-distributed .footer-icons {
            margin-top: 25px;
        }

        .footer-distributed .footer-icons a {
            display: inline-block;
            width: 35px;
            height: 35px;
            cursor: pointer;
            background-color: #33383b;
            border-radius: 2px;
            font-size: 20px;
            color: #ffffff;
            text-align: center;
            line-height: 35px;
            margin-right: 3px;
            margin-bottom: 5px;
        }

        .footer-distributed .footer-icons a:hover {
            background-color: #3F71EA;
        }

        .footer-links a:hover {
            color: #3F71EA;
        }

        @media (max-width: 880px) {
            .footer-distributed .footer-left, .footer-distributed .footer-center, .footer-distributed .footer-right {
                display: block;
                width: 100%;
                margin-bottom: 40px;
                text-align: center;
            }
            .footer-distributed .footer-center i {
                margin-left: 0;
            }
        }
    </style>


</body>

</html>