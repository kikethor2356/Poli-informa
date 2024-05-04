<?php 
    include '../LoginU/inicio.php';
    require '../../Conexion/conexion.php';
    $db = new Database();
    $conexion = $db->connect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/DiseñoAvisosU.css">
    <link rel="stylesheet" href="css/DiseñoCroquis.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Avisos</title>
</head>
<body>
    <?php include '../Partes/MenuUsuario.php'; ?>

    <div class="home">
        <div class="text">
            <h1>Avisos</h1><br>
                <?php
                    $consulta="SELECT * FROM avisos";
                    $row = mysqli_query($conexion, $consulta);

                    if (mysqli_num_rows($row) > 0){
                        $index = 0; // Variable para guardar el índice de la imagen actual
                        foreach($row as $fila){
                            $foto = $fila['foto'];
                            $id_aviso = $fila['id_aviso'];
                ?>
                            <div class="carusel-container">
                                <div class="item">
                                    <img src="<?php echo "../../Administrador/Avisos/fotos/".$fila['foto']; ?>" alt="imagen">
                                    <div class="referencia">
                                        <p class="completo">Mira el aviso completo al dar</p><a class="click" onclick="abrirVentanaVisualizar('<?php echo $fila['informacion']; ?>', <?php echo $index; ?>)"><b><i>"click"</i></b></a>
                                    </div>
                                </div>
                            </div>
                <?php
                            $index++;
                        }
                    } else {
                    }
                ?>
            <a class="anterior" onclick="anteriorBT()">﹤</a>
            <a class="siguiente" onclick="siguienteBT()">﹥</a>
 
            <script src="javaAvisos.js"></script>

                <!-- MOSTRAR: VENTANA MODAL -->
                <div class="ventanaVisualizarProducto" id="ventanaVisualizarProducto">
                    <div class="contenidoVentanaVisualizarProducto">
                        <!-- Contenido de la ventana emergente de visualización -->
                        <span class="close" onclick="cerrarVentanaVisualizar()">&times;</span>
                        <h2>Anuncio</h2>
                        <textarea name="" id="nombreProducto" cols="10" rows="17" readonly></textarea>
                        <button onclick="cerrarVentanaVisualizar()" class="vetanacerrarvista">Cerrar</button>
                    </div>
                </div>

                <!-- MOSTRAR: FUNCIONES JAVASCRIPT -->
                <script>
                    function abrirVentanaVisualizar(nombre) {
                        let modal = document.getElementById('ventanaVisualizarProducto'); // Obtenemos la ventana por su ID único
                        modal.classList.add('enseñar_Ver'); // Agrega la clase para mostrar la ventana

                        var nombreProducto = document.getElementById("nombreProducto");

                        nombreProducto.textContent = "Informacion: " + nombre;
                    }
                    function cerrarVentanaVisualizar() {
                        let modal = document.getElementById('ventanaVisualizarProducto'); // Obtenemos la ventana por su ID único
                        modal.classList.remove('enseñar_Ver'); // Removemos la clase para ocultar la ventana
                    }
                </script>

            <br><br><br><br><br><br>
            <div class="pregunta">
                ¿Te gustaria vender un producto?, registrate como vendedor en el siguiente link <a href="../Perfil/vendedorespen.php">Vendedores</a>
                <br><br>
                <p>Se vera un croquis de la escuela para que conozca las instalaciones que tiene y como llegar con indicaciones.</p>
            </div>
    
            <div class="secciones-escuela">
                <!-- Croquis -->
                <div id="croquis">        
                    <!-- Modulo A -->
                    <div>
                        <a name="principal" class="llamado1"></a>
                        <img class="clase1" src="imagenes/ENTRADA.jpg" alt="">
                    </div>

                    <div>
                        <a name="cafeteriaC" class="llamado2"></a>
                        <img class="clase2" src="imagenes/cafMA.jpg" alt="">
                    </div>

                    <div>
                        <a name="salonesMA" class="llamado3"></a>
                        <img class="clase3" src="imagenes/salonesMA.jpg" alt="">
                    </div>

                    <div>
                        <a name="prestamo" class="llamado4"></a>
                        <img class="clase4" src="imagenes/prestamo.jpg" alt="">
                    </div>

                    <div>
                        <a name="registro" class="llamado5"></a>
                        <img class="clase5" src="imagenes/registro.jpg" alt="">
                    </div>

                    <div>
                        <a name="bañoMA" class="llamado6"></a>
                        <img class="clase6" src="imagenes/bañoMA.jpg" alt="">
                    </div>

                    <div>
                        <a name="bañoHA" class="llamado7"></a>
                        <img class="clase7" src="imagenes/bañoHA.jpg" alt="">
                    </div>

                    <div>
                        <a name="labMA" class="llamado8"></a>
                        <img class="clase8" src="imagenes/labMA.jpg" alt="">
                    </div>

                    <!-- Modulo B -->
                    <div>
                        <a name="enfermeria" class="llamado9"></a>
                        <img class="clase9" src="imagenes/enfermeria.jpg" alt="">
                    </div>

                    <div>
                        <a name="salaM" class="llamado10"></a>
                        <img class="clase10" src="imagenes/salaM.jpg" alt="">
                    </div>

                    <div>
                        <a name="coordinacion" class="llamado11"></a>
                        <img class="clase11" src="imagenes/coordinacion.jpg" alt="">
                    </div>

                    <div>
                        <a name="salonesBPB" class="llamado12"></a>
                        <img class="clase12" src="imagenes/salonesBPB.jpg" alt="">
                    </div>

                    <div>
                        <a name="DireCon" class="llamado13"></a>
                        <img class="clase13" src="imagenes/DireCon.jpg" alt="">
                    </div>

                    <div>
                        <a name="SalBibOfi" class="llamado14"></a>
                        <img class="clase14" src="imagenes/SalBibOfi.jpg" alt="">
                    </div>

                    <div>
                        <a name="auditorio" class="llamado15"></a>
                        <img class="clase15" src="imagenes/auditorio.jpg" alt="">
                    </div>

                    <!-- Modulo C -->
                    <div>
                        <a name="bañoMC" class="llamado16"></a>
                        <img class="clase16" src="imagenes/bañoMC.jpg" alt="">
                    </div>

                    <div>
                        <a name="bañoHC" class="llamado17"></a>
                        <img class="clase17" src="imagenes/bañoHC.jpg" alt="">
                    </div>

                    <div>
                        <a name="labC" class="llamado18"></a>
                        <img class="clase18" src="imagenes/salonesC1.jpg" alt="">
                    </div>

                    <div>
                        <a name="salonesC1" class="llamado19"></a>
                        <img class="clase19" src="imagenes/salonesC1.jpg" alt="">
                    </div>

                    <!-- Modulo D -->
                    <div>
                        <a name="bañoI" class="llamado20"></a>
                        <img class="clase20" src="imagenes/bañoI.jpg" alt="">
                    </div>

                    <div>
                        <a name="bañoMDPB" class="llamado21"></a>
                        <img class="clase21" src="imagenes/bañoMDPB.jpg" alt="">
                    </div>

                    <div>
                        <a name="mayoriaD" class="llamado22"></a>
                        <img class="clase22" src="imagenes/mayoriaD.jpg" alt="">
                    </div>

                    <div>
                        <a name="salonD" class="llamado23"></a>
                        <img class="clase23" src="imagenes/salonD.jpg" alt="">
                    </div>

                    <div>
                        <a name="labEspecializado" class="llamado24"></a>
                        <img class="clase24" src="imagenes/labEspecializado.jpg" alt="">
                    </div>

                    <!-- Modulo E -->
                    <div>
                        <a name="bañoME" class="llamado25"></a>
                        <img class="clase25" src="imagenes/bañoME.jpg" alt="">
                    </div>

                    <div>
                        <a name="bañoHE" class="llamado26"></a>
                        <img class="clase26" src="imagenes/bañoHE.jpg" alt="">
                    </div>

                    <div>
                        <a name="labE" class="llamado27"></a>
                        <img class="clase27" src="imagenes/labE.jpg" alt="">
                    </div>

                    <div>
                        <a name="aulaAmpliada" class="llamado28"></a>
                        <img class="clase28" src="imagenes/aulaAmpliada.jpg" alt="">
                    </div>

                    <div>
                        <a name="becas" class="llamado29"></a>
                        <img class="clase29" src="imagenes/aulaBecas.jpg" alt="">
                    </div>

                    <div>
                        <a name="salonesE" class="llamado30"></a>
                        <img class="clase30" src="imagenes/salonesE.jpg" alt="">
                    </div>

                    <div>
                        <a name="lab" class="llamado31"></a>
                        <img class="clase31" src="imagenes/lab.jpg" alt="">
                    </div>

                    <div>
                        <a name="labE" class="llamado32"></a>
                        <img class="clase32" src="imagenes/labE.jpg" alt="">
                    </div>

                    <!-- Modulo F -->
                    <div>
                        <a name="bañoMF" class="llamado33"></a>
                        <img class="clase33" src="imagenes/bañoMF.jpg" alt="">
                    </div>

                    <div>
                        <a name="bañoHF" class="llamado34"></a>
                        <img class="clase34" src="imagenes/bañoHF.jpg" alt="">
                    </div>

                    <div>
                        <a name="salonesFPB" class="llamado35"></a>
                        <img class="clase35" src="imagenes/salonesFPB.jpg" alt="">
                    </div>

                    <div>
                        <a name="salonesF12" class="llamado36"></a>
                        <img class="clase36" src="imagenes/salonesF12.jpg" alt="">
                    </div>
                </div>
                <!-- Fin de croquis-->

                <!-- Menu de las sessiones de la escuela -->
                <div class="menuC acti">
                    <div class="opcion">
                        <div class="titulo1">
                            <span class="titu">Secciones de la escuela</span>
                        </div><br>
                        <ul>
                            <li class="submenu">
                                <a href="#principal">
                                    <span class="subtitulo">Entrada</span>
                                </a>
                            </li>
                            <!-- Modulo A -->
                            <li class="submenu">
                                <a>
                                    <span class="subtitulo">Modulo A</span>
                                    <i class="hilo fa-solid fa-angle-down"></i>
                                </a>
                                <ul class="sub-opcion">
                                    <li class="submenu2">
                                        <a href="#salonesMA">
                                            <span class="subtitulo">Salones A(1-8)</span>
                                            <i class="hilo fa-solid fa-angle-down"></i>
                                        </a> 
                                        <ul class="sub-opcion2">
                                            <li>
                                                    <span class="titu">Como llegar</span>
                                                    <a><span class="subtitulo">Subir las escaleras y al lado derecho se encontraran los salones.</span>
                                                    </a>
                                            </li>
                                        </ul>                                 
                                    </li>
                                    <li>
                                        <a href="#prestamo">
                                            <span class="subtitulo">Prestamo de equipo</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#cafeteriaC">
                                            <span class="subtitulo">Cafeteria</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#registro">
                                            <span class="subtitulo">Registro de listas</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#bañoMA">
                                            <span class="subtitulo">Baño M</span>
                                        </a>
                                    </li>
                                    <li class="submenu2">
                                        <a href="#bañoHA">
                                            <span class="subtitulo">Baño H</span>
                                            <i class="hilo fa-solid fa-angle-down"></i>
                                        </a>
                                        <ul class="sub-opcion2">
                                            <span class="titu">Como llegar</span>
                                            <a><span class="subtitulo">Subir las escaleras y al lado izquierdo estara el baño.</span></a>                                
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#labMA">
                                            <span class="subtitulo">Laboratorio quimicos</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>  
                            <!-- Modulo B -->
                            <li class="submenu">
                                <a>
                                    <span class="subtitulo">Modulo B</span>
                                    <i class="hilo fa-solid fa-angle-down"></i>
                                </a>
                                <ul class="sub-opcion">
                                    <li>
                                        <a href="#enfermeria">
                                            <span class="subtitulo">enfermeria</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#salaM">
                                            <span class="subtitulo">Sala de maestros</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#coordinacion">
                                            <span class="subtitulo">Coordinacion academica</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#auditorio">
                                            <span class="subtitulo">Auditorio</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#salonesBPB">
                                            <span class="subtitulo">Salones B(x-x)</span>
                                        </a>
                                    </li>
                                    <li class="submenu2">
                                        <a href="#SalBibOfi">
                                            <span class="subtitulo">Salones B(x-x)</span>
                                            <i class="hilo fa-solid fa-angle-down"></i>
                                        </a>
                                        <ul class="sub-opcion2">
                                            <span class="titu">Como llegar</span>
                                            <a><span class="subtitulo">Subir las escaleras y al lado izquierdo estaran los salones.</span></a>                                
                                        </ul>
                                    </li>
                                    <li class="submenu2">
                                        <a href="#DireCon">
                                            <span class="subtitulo">Direccion</span>
                                            <i class="hilo fa-solid fa-angle-down"></i>
                                        </a>
                                        <ul class="sub-opcion2">
                                            <span class="titu">Como llegar</span>
                                            <a><span class="subtitulo">Subir las escaleras y al lado izquierdo estara la direccion.</span></a>                                
                                        </ul>
                                    </li>
                                    <li class="submenu2">
                                        <a href="#DireCon">
                                            <span class="subtitulo">Control escolar</span>
                                            <i class="hilo fa-solid fa-angle-down"></i>
                                        </a>
                                        <ul class="sub-opcion2">
                                            <span class="titu">Como llegar</span>
                                            <a><span class="subtitulo">Subir las escaleras y al lado derechio estara control escolar.</span></a>                                
                                        </ul>
                                    </li>
                                    <li class="submenu2">
                                        <a href="#SalBibOfi">
                                            <span class="subtitulo">Biblioteca</span>
                                            <i class="hilo fa-solid fa-angle-down"></i>
                                        </a>
                                        <ul class="sub-opcion2">
                                            <span class="titu">Como llegar</span>
                                            <a><span class="subtitulo">Subir las escaleras y al lado izquierdo estara biblioteca.</span></a>                                
                                        </ul>
                                    </li>
                                    <li class="submenu2">
                                        <a href="#SalBibOfi">
                                            <span class="subtitulo">Oficilia mayor</span>
                                            <i class="hilo fa-solid fa-angle-down"></i>
                                        </a>
                                        <ul class="sub-opcion2">
                                            <span class="titu">Como llegar</span>
                                            <a><span class="subtitulo">Subir las escaleras y enfrente estara oficilia mayor.</span></a>                                
                                        </ul>
                                    </li>
                                </ul>
                            </li> 
                            <!-- MODULO C -->
                            <li class="submenu">
                                <a>
                                    <span class="subtitulo">Modulo C</span>
                                    <i class="hilo fa-solid fa-angle-down"></i>
                                </a>
                                <ul class="sub-opcion">
                                    <li>
                                        <a href="#bañoMC">
                                            <span class="subtitulo">Baño M</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#bañoHC">
                                            <span class="subtitulo">Baño H</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#labC">
                                            <span class="subtitulo">Laboratorio</span>
                                        </a>
                                    </li>
                                    <li class="submenu2">
                                        <a href="#salonesC1">
                                            <span class="subtitulo">Salones C(x-x)</span>
                                            <i class="hilo fa-solid fa-angle-down"></i>
                                        </a>
                                        <ul class="sub-opcion2">
                                            <span class="titu">Como llegar</span>
                                            <a><span class="subtitulo">Subir las escaleras y por todo el pasillo estaran los salones.</span></a>                                
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <!-- Modulo D -->
                            <li class="submenu">
                                <a>
                                    <span class="subtitulo">Modulo D</span>
                                    <i class="hilo fa-solid fa-angle-down"></i>
                                </a>
                                <ul class="sub-opcion">
                                    <li>
                                        <a href="#bañoI">
                                            <span class="subtitulo">Baño inclusivo</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#bañoMDPB">
                                            <span class="subtitulo">Baño M(PB)</span>
                                        </a>
                                    </li>
                                    <li class="submenu2">
                                        <a href="#mayoriaD">
                                            <span class="subtitulo">Baño M(P1)</span>
                                            <i class="hilo fa-solid fa-angle-down"></i>
                                        </a>
                                        <ul class="sub-opcion2">
                                            <span class="titu">Como llegar</span>
                                            <a><span class="subtitulo">Subir las escaleras hasta el primer piso y al lado izquierdo estara el baño.</span></a>                                
                                        </ul>
                                    </li>
                                    <li class="submenu2">
                                        <a href="#mayoriaD">
                                            <span class="subtitulo">Baño H</span>
                                            <i class="hilo fa-solid fa-angle-down"></i>
                                        </a>
                                        <ul class="sub-opcion2">
                                            <span class="titu">Como llegar</span>
                                            <a><span class="subtitulo">Subir las escaleras al segundo piso y al lado izquierdo estara el baño.</span></a>                                
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#labEspecializado">
                                            <span class="subtitulo">Laboratorio especializado</span>
                                        </a>
                                    </li>
                                    <li class="submenu2">
                                        <a href="#mayoriaD">
                                            <span class="subtitulo">Laboratorio de redes</span>
                                            <i class="hilo fa-solid fa-angle-down"></i>
                                        </a>
                                        <ul class="sub-opcion2">
                                            <span class="titu">Como llegar</span>
                                            <a><span class="subtitulo">Subir las escaleras al primer piso y al lado izquierdo estara el laboratorio de redes.</span></a>                                
                                        </ul>
                                    </li>
                                    <li class="submenu2">
                                        <a href="#mayoriaD">
                                            <span class="subtitulo">Laboratorio informatico</span>
                                            <i class="hilo fa-solid fa-angle-down"></i>
                                        </a>
                                        <ul class="sub-opcion2">
                                            <span class="titu">Como llegar</span>
                                            <a><span class="subtitulo">Subir las escaleras al segundo piso y al lado izquierdo estara el laboratorio informatico.</span></a>                                
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#salonD">
                                            <span class="subtitulo">Salon D(x)</span>
                                        </a>
                                    </li>
                                    <li class="submenu2">
                                        <a href="#mayoriaD">
                                            <span class="subtitulo">Salones D(x-x)</span>
                                            <i class="hilo fa-solid fa-angle-down"></i>
                                        </a>
                                        <ul class="sub-opcion2">
                                            <span class="titu">Como llegar</span>
                                            <a><span class="subtitulo">Subir las escaleras al primer piso y al lado derecho estaran los salones.</span></a>                                
                                        </ul>
                                    </li>
                                    <li class="submenu2">
                                        <a href="#mayoriaD">
                                            <span class="subtitulo">salones D(x-x) </span>
                                            <i class="hilo fa-solid fa-angle-down"></i>
                                        </a>
                                        <ul class="sub-opcion2">
                                            <span class="titu">Como llegar</span>
                                            <a><span class="subtitulo">Subir las escaleras al segundo piso y al lado derecho estaran los salones.</span></a>                                
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <!-- Modulo E -->
                            <li class="submenu">
                                <a>
                                    <span class="subtitulo">Modulo E</span>
                                    <i class="hilo fa-solid fa-angle-down"></i>
                                </a>
                                <ul class="sub-opcion">
                                    <li>
                                        <a href="#bañoME">
                                            <span class="subtitulo">Baño M</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#bañoHE">
                                            <span class="subtitulo">Baño H</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#lab">
                                            <span class="subtitulo">Laboratorios</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#aulaAmpliada">
                                            <span class="subtitulo">Aula ampliada</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#becas">
                                            <span class="subtitulo">Aula de becas</span>
                                        </a>
                                    </li>
                                    <li class="submenu2">
                                        <a href="#labE">
                                            <span class="subtitulo">Laboratorio de computo</span>
                                            <i class="hilo fa-solid fa-angle-down"></i>
                                        </a>
                                        <ul class="sub-opcion2">
                                            <span class="titu">Como llegar</span>
                                            <a><span class="subtitulo">Subir las escaleras al primer piso y al lado derecho estara el laboratorio de computo.</span></a>                                
                                        </ul>
                                    </li>
                                    <li class="submenu2">
                                        <a href="#salonesE">
                                            <span class="subtitulo">salones E(x-x) </span>
                                            <i class="hilo fa-solid fa-angle-down"></i>
                                        </a>
                                        <ul class="sub-opcion2">
                                            <span class="titu">Como llegar</span>
                                            <a><span class="subtitulo">Subir las escaleras al primer piso y al lado izquierdo estaran los salones.</span></a>                                
                                        </ul>
                                    </li>
                                    <li class="submenu2">
                                        <a href="#salonesE">
                                            <span class="subtitulo">salones E(x-x) </span>
                                            <i class="hilo fa-solid fa-angle-down"></i>
                                        </a>
                                        <ul class="sub-opcion2">
                                            <span class="titu">Como llegar</span>
                                            <a><span class="subtitulo">Subir las escaleras al segundo piso y al lado izquierdo estaran los salones.</span></a>                                
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <!-- MODULO F -->
                            <li class="submenu">
                                <a>
                                    <span class="subtitulo">Modulo F</span>
                                    <i class="hilo fa-solid fa-angle-down"></i>
                                </a>
                                <ul class="sub-opcion">
                                    <li>
                                        <a href="#bañoMF">
                                            <span class="subtitulo">Baño M</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#bañoHF">
                                            <span class="subtitulo">Baño H</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#salonesFPB">
                                            <span class="subtitulo">Salones F(x-x)</span>
                                        </a>
                                    </li>
                                    <li class="submenu2">
                                        <a href="#salonesF12">
                                            <span class="subtitulo">Salones F(x-x)</span>
                                            <i class="hilo fa-solid fa-angle-down"></i>
                                        </a>
                                        <ul class="sub-opcion2">
                                            <span class="titu">Como llegar</span>
                                            <a><span class="subtitulo">Subir las escaleras al primer piso y al lado derecho estaran los salones.</span></a>                                
                                        </ul>
                                    </li>
                                    <li class="submenu2">
                                        <a href="#salonesF12">
                                            <span class="subtitulo">Salones F(x-x)</span>
                                            <i class="hilo fa-solid fa-angle-down"></i>
                                        </a>
                                        <ul class="sub-opcion2">
                                            <span class="titu">Como llegar</span>
                                            <a><span class="subtitulo">Subir las escaleras al segundo piso y al lado derecho estaran los salones.</span></a>                                
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <!-- Modulo G -->
                            <li class="submenu">
                                <a>
                                    <span class="subtitulo">Modulo G</span>
                                    <i class="hilo fa-solid fa-angle-down"></i>
                                </a>
                                <ul class="sub-opcion"> 
                                    
                                </ul>
                            </li>
                            <!-- Modulo H -->
                            <li class="submenu">
                                <a>
                                    <span class="subtitulo">Modulo H</span>
                                    <i class="hilo fa-solid fa-angle-down"></i>
                                </a>
                                <ul class="sub-opcion"> 
                                    
                                </ul>
                            </li>
                            <!-- Modulo I -->
                            <li class="submenu">
                                <a>
                                    <span class="subtitulo">Modulo I</span>
                                    <i class="hilo fa-solid fa-angle-down"></i>
                                </a>
                                <ul class="sub-opcion"> 
                                    
                                </ul>
                            </li>
                            <!-- Modulo J -->
                            <li class="submenu">
                                <a>
                                    <span class="subtitulo">Modulo J</span>
                                    <i class="hilo fa-solid fa-angle-down"></i>
                                </a>
                                <ul class="sub-opcion"> 
                                    
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div><!-- Fin de menu de sessiones-->
            </div>
            
        </div><!-- Fin de text -->
    </div><!-- Fin de home -->

    <?php include '../Partes/footer.php'; ?>

    <!-- Script para los botones del menu -->
    <script>
        $(document).ready(function(){
            // Función para mostrar/ocultar el primer nivel de submenús
            $(".submenu > a").click(function(){
                var subMenu = $(this).next(".sub-opcion");
                // Cerrar otros submenús de primer nivel
                $(".submenu").not($(this).parent()).find(".sub-opcion").slideUp();
                // Cambiar la flecha de otros submenús de primer nivel
                $(".submenu").not($(this).parent()).find(".hilo").removeClass("fa-angle-up").addClass("fa-angle-down");
                // Mostrar u ocultar el submenú actual
                subMenu.slideToggle();
                $(this).find(".hilo").toggleClass("fa-angle-down fa-angle-up");
            });

            // Función para mostrar/ocultar el segundo nivel de submenús
            $(".submenu2 > a").click(function(){
                var subMenu = $(this).next(".sub-opcion2");
                // Cerrar otros submenús de segundo nivel
                $(".submenu2").not($(this).parent()).find(".sub-opcion2").slideUp();
                // Cambiar la flecha de otros submenús de segundo nivel
                $(".submenu2").not($(this).parent()).find(".hilo").removeClass("fa-angle-up").addClass("fa-angle-down");
                // Mostrar u ocultar el submenú actual
                subMenu.slideToggle();
                $(this).find(".hilo").toggleClass("fa-angle-down fa-angle-up");
            });
        });
    </script>


</body>
</html>