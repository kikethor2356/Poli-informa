<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../../style/diseño.css">
    <script src="../../js/productos.js"></script>
    <title>Document</title>
</head>
<body>
    

        <!-- OPCIÓN PARA AGREGAR PRODUCTO -->
        <div id="agregar">
                            
            <!-- DATOS DEL PRODUCTO -->
            <div id="agregar-producto">

                <div id="cerrar">✖</div>

                <h1>Nuevo Producto</h1>

                <form action="../BD/Acciones.php?metodo=1" method="post" id="contenedor" name="contenedor" enctype="multipart/form-data">

                    <input type="text" id="nombre" name="nombre" placeholder="Nombre del producto"><br><br>
                    
                    <input type="text" id="codigoVendedor" name="codigoVendedor" placeholder="Vendedor"><br>

                    <p>Precio:  $ <input type="text" id="precio" name="precio"> MXN</p>

                    <textarea id="descripcion" name="descripcion" placeholder="Descripción" ></textarea><br><br>
                    
                    <input type="file" id="imagen" name="imagen" onchange="archivoSeleccionado(event)">

                    <label for="imagen" id="labelArchivo"><i class="fa-solid fa-upload"></i>  elegir imagen</label><br><br>

                    <input type="text" id="nombreArchivo" readonly><br>
                    
                    <input type="submit" value="Subir producto" id="enviar" name="enviar">

            <!-- FIN DATOS DEL PRODUCTO-->

            <!-- PIDE LA CATEGORÍA A LA QUE PERTENECE EL PRODUCTO -->


            <div id="contenedor-categoria">

                <h2>Categoría del producto</h2>

                <ul>
                    <li>
                        <input type="radio" name="categoria" id="Dulce" value="Dulce" checked>
                        <label for="Dulce">Dulce</label>

                    </li>

                    <li>
                        <input type="radio" name="categoria" id="Salado" value="Salado">
                        <label for="Salado">Salado</label>

                    </li>

                    <li>
                        <input type="radio" name="categoria" id="Mezclado" value="Mezclado">
                        <label for="Mezclado">Mezclado</label>
                    </li>

                    <li>
                        <input type="radio" name="categoria" id="Tecnología" value="Tecnología">
                        <label for="Tecnología">Tecnología</label>
                    </li>

                </ul>

            <!-- FIN DIV AGREGAR CATEGORÍA -->
            </div>

                </form>

            <!-- FIN DE LA OPCIÓN PARA AGREGAR UN PRODUCTO -->
            </div>

            <!-- FIN DEL CONTENEDOR PARA AGREGAR PRODUCTO -->
        </div>



</body>
</html>