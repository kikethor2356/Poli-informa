<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/modales.css">
    <script src="../../js/productos.js"></script>
    <title>Editar</title>
</head>
<body>

    <?php 

        include("../../../../Conexion/conexion.php");
        $idProducto = (int) filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT);
        $sqlProducto = ("SELECT * FROM productos where id='$idProducto' LIMIT 1");
        $queryProducto = mysqli_query($conexion, $sqlProducto);
        $dataProducto = mysqli_fetch_array($queryProducto);
        
    ?>


    <div id="ventana-editar-producto">

        <h1>Editar producto</h1><br>

        <div id="iconoSalir" onclick="ocultarEditar()">✖</div>

        <form action="Acciones.php?metodo=2" method="POST" id="formulario-editar" enctype="multipart/form-data">

            <label for="idProducto" id="paraId">ID: </label>
            <input type="text" id="idProducto" name="idProducto" value="<?php echo $dataProducto['ID']; ?>" readonly><br>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="texto" value="<?php echo $dataProducto['nombre']; ?>"><br><br>
                
            <label for="vendedor">Vendedor:</label>
            <input type="text" id="vendedor" name="vendedor" class="texto" value="<?php echo $dataProducto['codigoVendedor']; ?>"><br><br>   

            <label for="precio">Precio: </label>
            <input type="text" id="precio" name="precio" class="texto" value="<?php echo $dataProducto['precio']; ?>"><br><br>

            <label for="descripcionEditar">Descripción: </label><br>
            <textarea name="descripcionEditar" id="descripcionEditar"><?php echo $dataProducto['descripcion']; ?></textarea><br><br>

            <input type="file" id="archivo" name="archivo" onchange="mostrarArchivoEnEditar(event)">
            <label for="archivo" id="label-archivo">Imagen</label>
            <input type="text" id="nombre-archivo" name="nombre-archivo" disabled value="<?php echo $dataProducto['nombreImagen']; ?>"><br><br>

            <label for="comboBoxCategoria">Categoria: </label>
            <select id="comboBoxCategoria" name="comboBoxCategoria">
            <?php
               if($dataProducto['categoria'] == "Dulce"){
                echo '<option value="Dulce" selected>Dulce</option>';
                echo '<option value="Salado">Salado</option>';
                echo '<option value="Mezclado">Mezclado</option>';
                echo '<option value="Tecnología">Tecnología</option>';
                }else if($dataProducto['categoria'] == "Salado"){
                echo '<option value="Dulce">Dulce</option>';
                echo '<option value="Salado" selected>Salado</option>';
                echo '<option value="Mezclado">Mezclado</option>';
                echo '<option value="Tecnología">Tecnología</option>';
                }else if($dataProducto['categoria'] == "Mezclado"){
                echo '<option value="Dulce">Dulce</option>';
                echo '<option value="Salado">Salado</option>';
                echo '<option value="Mezclado" selected>Mezclado</option>';
                echo '<option value="Tecnología">Tecnología</option>';
                }else{
                echo '<option value="Dulce">Dulce</option>';
                echo '<option value="Salado">Salado</option>';
                echo '<option value="Mezclado">Mezclado</option>';
                echo '<option value="Tecnología" selected>Tecnología</option>';
                }
                ?>
            </select>

            <div id="raya"></div>

            <input type="reset" id="borrar" name="borrar" value="Cancelar">
            <input type="submit" id="enviar" name="enviar" value="Guardar">

            </form>     


        </div>


</body>
</html>





