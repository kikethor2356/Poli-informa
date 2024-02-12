<?php
// Incluye el archivo de configuración que contiene las variables de entorno
include 'config.php';

// Obtiene los valores de las variables de entorno para la conexión a la base de datos
$host = getenv('DB_HOST');      // Host de la base de datos
$dbname = getenv('DB_NAME');    // Nombre de la base de datos
$username = getenv('DB_USER');  // Usuario de la base de datos
$password = getenv('DB_PASS');  // Contraseña de la base de datos

// Intenta establecer la conexión PDO
try {
    // Crea una nueva instancia de PDO con los parámetros de conexión
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Configura el modo de error para que lance excepciones en caso de error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Imprime un mensaje de éxito si la conexión se estableció correctamente
    echo "Conexión exitosa";
} catch (PDOException $e) {
    // Captura cualquier excepción que ocurra durante la conexión y muestra un mensaje de error
    die("Error al conectar: " . $e->getMessage());
}
?>
