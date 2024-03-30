<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/modales.css">
    <title>Ventana eliminar</title>
</head>
<body>

    <?php 

        include("../../../../Conexion/conexion.php");
        $idProducto = (int) filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        $sqlProducto = ("SELECT * FROM productos where id='$idProducto' ");
        $queryProducto = mysqli_query($conexion, $sqlProducto);
        $dataProducto = mysqli_fetch_array($queryProducto);

    ?>




    <div id="ventana-eliminar">

        <h1>Eliminar registro</h1>

        <div id="salir" onclick="ocultarEditar()">✖</div>

        <div id="raya1"></div>



        <form action="Acciones.php?metodo=3" method="post" enctype="multipart/form-data" id="formulario-eliminar">


            <div id="contenedor-eliminar">

                
                <p>¿Desea eliminar el registro número <span><b><input type="text" id="texto-eliminar" name="texto-eliminar" value="<?php echo $dataProducto['ID']; ?>" readonly><?php echo $dataProducto['ID']; ?></b>?</p>
           
            </div>

            <input type="text" id="archivoEliminar" name="archivoEliminar" value="<?php echo $dataProducto['nombreImagen']; ?>" hidden>

            <button id="cancelar" type="reset">Cancelar</button>
            <input type="submit" name="enviar" id="enviar" value="Borrar">

        </form>

        <div id="raya2"></div>

    </div>




    
</body>
</html>