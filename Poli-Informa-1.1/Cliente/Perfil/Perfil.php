<?php
    include '../LoginU/inicio.php';
    include('../../Conexion/conexion.php');
    $db = new Database();
    $conexion = $db->connect();
?>
<?php include '../LoginU/inicio.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Perfil.css">
    <link rel="stylesheet" href="css/diseño.css">
    <link rel="stylesheet" href="css/vendedores.css">
    <script src="js/perfil.js"></script>
    <title>Mi perfil</title>
</head>
<body>
    <?php include '../Partes/MenuUsuario.php'; ?>
    <div class="home">
        <div class="text">
            <div class="contenedor">
                <?php
                    // Obtener el código de usuario de la sesión
                    $codeAlu = $_SESSION['CodeAlu'];
                    // Consultar la base de datos para obtener los datos del usuario y su estado de vendedor
                    $stmt = $conexion->prepare("SELECT AluImage, CodeAlu, AluNom, AluApellidoP, AluApellidoM, AluCarrera, AluCorreo, esVendedor FROM registroalu WHERE CodeAlu = ?");
                    $stmt->bind_param("s", $codeAlu);
                    $stmt->execute();
                    $result = $stmt->get_result();                
                    // Verificar si se encontró un registro
                    if($result->num_rows === 1) {
                        $mostrar = $result->fetch_assoc();
                        // Mostrar los datos del usuario
                        ?>
                        <div class="contenidoImg">
                            <?php echo htmlspecialchars($mostrar["AluImage"]); ?>
                        </div><br>
                        <div class="c_code">
                            <h3><?php echo htmlspecialchars($mostrar["CodeAlu"]); ?></h3>
                        </div><br>
                        <div class="c_nombre">
                            <h3><?php echo htmlspecialchars($mostrar["AluNom"] . " " . $mostrar["AluApellidoP"] . " " . $mostrar["AluApellidoM"]); ?></h3>
                        </div><br>
                        <div class="c_carrera">
                            <h4><?php echo htmlspecialchars($mostrar["AluCarrera"]); ?></h4>
                        </div><br>
                        <div class="c_correo">
                            <h4><?php echo htmlspecialchars($mostrar["AluCorreo"]); ?></h4>
                        </div><br>
                        <?php                
                        $esVendedor = $mostrar['esVendedor'];                
                        // Mostrar enlaces según el valor de esVendedor
                        if ($esVendedor) {    
                            echo '<section class="productos"><a href="#productos" onclick="formularioproducto(1)">Subir productos</a></section>';
                        } else {
                            echo '<section class="vendedores"><a href="vendedorespen.php">Registrarse como vendedor</a></section>';
                        }
                    } else {
                        // Mostrar un mensaje si no se encuentra el usuario en la base de datos
                        echo "<p>No se encontraron datos de usuario.</p>";
                    }
                ?>
                <!-- Formulario de productos -->
                <main id="contenedor-principal" hidden>
                    <h1><a name="productos"></a>Registro de productos</h1>
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
            </div>
        </div>
    </div>
</body>
</html>