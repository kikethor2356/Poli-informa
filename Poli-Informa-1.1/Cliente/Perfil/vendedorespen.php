<?php 
include '../LoginU/inicio.php';
include '../../Conexion/conexion.php';
$db = new Database();
$conexion = $db->connect();

// Verificar si el código del estudiante está presente en la sesión
if(isset($_SESSION['CodeAlu'])) {
    // Obtener el código de usuario de la sesión
    $codeAlu = $_SESSION['CodeAlu'];

    // Consultar la base de datos para obtener los datos del usuario
    $stmt = $conexion->prepare("SELECT AluNom, AluCorreo FROM registroalu WHERE CodeAlu = ?");
    $stmt->bind_param("s", $codeAlu);
    $stmt->execute();
    $result = $stmt->get_result();
    $userData = $result->fetch_assoc();
    $stmt->close();
} else {
    // Manejar el caso en el que el código del estudiante no está presente en la sesión
    echo "Error: El código del estudiante no está presente en la sesión.";
    exit();
}
?> 

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preload" href="css/diseño.css" as="style">
    <link rel="stylesheet" href="css/vendedores.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">    <title>Vendedores</title>
</head>
<body>
    <?php include "../Partes/MenuUsuario.php"; ?> 
    <div class="home">
        <div class="text">
            <main class="contenedor-principal">
                <h1>Registro de vendedores</h1>
                <a href="Perfil.php">Regresar</a>
                <form class="formulario" action="almacenarVendedores.php" method="post" enctype="multipart/form-data">
                    <fieldset class="fieldset">
                        <h2 class="fieldset__titulo">Información del vendedor</h2>
                        <div class="campo">
                            <label for="codigo">Código de estudiante</label>
                            <input type="text" id="codigo" name="codigo" value="<?php echo isset($codeAlu) ? $codeAlu : ''; ?>" readonly>
                        </div> <!-- .campo -->
                        <div class="campo">
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre" name="nombre" value="<?php echo isset($userData['AluNom']) ? htmlspecialchars($userData['AluNom']) : ''; ?>" readonly>
                        </div> <!-- .campo -->
                        <div class="campo">
                            <label for="descripcion">Descripción</label>
                            <textarea name="descripcion" id="descripcion" required></textarea>
                        </div> <!-- .campo -->
                        <div class="campo">
                            <label for="correo">Correo institucional</label>
                            <input type="email" id="correo" name="correo" value="<?php echo isset($userData['AluCorreo']) ? htmlspecialchars($userData['AluCorreo']) : ''; ?>" readonly>
                        </div> <!-- .campo -->
                        <div class="campo">
                            <label for="telefono">Teléfono</label>
                            <input type="tel" id="telefono" name="telefono" required>
                        </div> <!-- .campo -->
                        <div class="campo">
                            <label for="hora-inicio">Hora de inicio de ventas</label>
                            <select name="hora-inicio" id="hora-inicio" required>
                                <option disabled selected>-- Seleccionar --</option>
                                <option value="7:00 am">7:00 am</option>
                                <option value="8:00 am">8:00 am</option>
                                <option value="9:00 am">9:00 am</option>
                                <option value="10:00 am">10:00 am</option>
                                <option value="11:00 am">11:00 am</option>
                                <option value="12:00 pm">12:00 pm</option>
                                <option value="13:00 pm">13:00 pm</option>
                                <option value="14:00 pm">14:00 pm</option>
                                <option value="15:00 pm">15:00 pm</option>
                                <option value="16:00 pm">16:00 pm</option>
                                <option value="17:00 pm">17:00 pm</option>
                                <option value="18:00 pm">18:00 pm</option>
                                <option value="19:00 pm">19:00 pm</option>
                                <option value="20:00 pm">20:00 pm</option>
                            </select>
                        </div> <!-- .campo -->
                        <div class="campo">
                            <label for="hora-fin">Hora de fin de ventas</label>
                            <select name="hora-fin" id="hora-fin" required>
                                <option disabled selected>-- Seleccionar --</option>
                                <option value="7:00 am">7:00 am</option>
                                <option value="8:00 am">8:00 am</option>
                                <option value="9:00 am">9:00 am</option>
                                <option value="10:00 am">10:00 am</option>
                                <option value="11:00 am">11:00 am</option>
                                <option value="12:00 pm">12:00 pm</option>
                                <option value="13:00 pm">13:00 pm</option>
                                <option value="14:00 pm">14:00 pm</option>
                                <option value="15:00 pm">15:00 pm</option>
                                <option value="16:00 pm">16:00 pm</option>
                                <option value="17:00 pm">17:00 pm</option>
                                <option value="18:00 pm">18:00 pm</option>
                                <option value="19:00 pm">19:00 pm</option>
                                <option value="20:00 pm">20:00 pm</option>
                                <option value="21:00 pm">21:00 pm</option>
                            </select>
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