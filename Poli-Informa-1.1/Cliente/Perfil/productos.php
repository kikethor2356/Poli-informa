<?php include '../LoginU/inicio.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preload" href="css/diseño.css" as="style">
    <link rel="stylesheet" href="css/vendedores.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">    
    <title>Vendedores</title>
</head>
<body>
    <?php include "../Partes/MenuUsuario.php"; ?> 
    <div class="home">
        <div class="text">

            <main class="contenedor-principal">
                <h1>Registro de productos</h1>
                <a href="Perfil.php">Regresar</a>
                <form class="formulario" action="almacenarVendedores.php" method="post" enctype="multipart/form-data">
                    <fieldset class="fieldset">
                        <h2 class="fieldset__titulo">Información del producto</h2>
                        <div class="campo">
                            <label for="nombre">Nombre del producto</label>
                            <input type="text" id="nombre" name="nombre" required>
                        </div> <!-- .campo -->
                        <div class="campo">
                            <label for="nombre">Nombre del vendedor</label>
                            <input type="text" id="nombrevendedor" name="nombrevendedor" required>
                        </div> <!-- .campo -->
                        <div class="campo">
                            <label for="nombre">Precio del producto</label>
                            <input type="text" id="precio" name="precio" required>
                        </div> <!-- .campo -->
                        <div class="campo">
                            <label for="descripcion">Descripción del producto</label>
                            <textarea name="descripcion" id="descripcion" required></textarea>
                        </div> <!-- .campo -->                        
                        <div class="campo">
                            <label for="imagen">Fotografía</label>
                            <input type="file" name="imagen" id="imagen" accept="image/*" required>
                        </div> <!-- .campo -->
                        <input type="submit" name="guardar" id="guardar">
                    </fieldset>
                </form>
            </main>
        </div> <!-- .text -->
    </div> <!-- .home -->
    <?php include "../Partes/footer-page/index.html"; ?>
</body>
</html>