<?php
include "../../Conexion/conexion.php";

function obtenerOpcionesCombo($conn)
{
    // Consulta SQL para obtener los valores de la base de datos
    $sql = "SELECT Nombre FROM maestros";
    $result = $conn->query($sql);

    // Array para almacenar las opciones
    $opciones = array();

    // Verificar si se encontraron resultados
    if ($result->num_rows > 0) {
        // Obtener los valores y guardarlos en el array de opciones
        while ($row = $result->fetch_assoc()) {
            $opciones[] = $row['Nombre'];
        }
    } else {
        echo "No se encontraron opciones en la base de datos.";
    }

    // Retornar el array de opciones
    return $opciones;
}

function obtenerOpcionesLaboratorio($conn)
{
    // Consulta SQL para obtener los valores de la base de datos
    $sql = "SELECT Nombre FROM laboratorios";
    $result = $conn->query($sql);

    // Array para almacenar las opciones
    $opciones = array();
    // Verificar si se encontraron resultados
    if ($result->num_rows > 0) {
        // Obtener los valores y guardarlos en el array de opciones
        while ($row = $result->fetch_assoc()) {
            $opciones[] = $row['Nombre'];
        }
    } else {
        echo "No se encontraron opciones en la base de datos.";
    }

    // Retornar el array de opciones
    return $opciones;
}

function mostrar($conn)
{
    $opciones = obtenerOpcionesCombo($conn);
    // Mostrar las opciones en un combo box
    echo "<select name='maestro'>";
    foreach ($opciones as $opcion) {
        echo "<option value='$opcion'>$opcion</option>";
    }
    echo "</select>";

    $opciones = obtenerOpcionesLaboratorio($conn);
    // Mostrar las opciones en un combo box
    echo "<select name='nombre_laboratorio'>";
    foreach ($opciones as $opcion) {
        echo "<option value='$opcion'>$opcion</option>";
    }
    echo "</select>";
}

// Ejemplo de uso
$database = new Database();
$conn = $database->connect();
mostrar($conn);
?>
