<?php
    

function obtenerOpcionesCombo($db, $tabla)
{
    // Consulta SQL para obtener los valores de la base de datos
    $sql = "SELECT Nombre FROM $tabla";
    $result = $db->query($sql);

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

function mostrarOpcionesMaestros($conn)
{
    $opciones = obtenerOpcionesCombo($conn, "maestros");
    // Mostrar las opciones en un combo box
    echo "<select name='maestro' style='margin: 10px; padding: 8px; background:	#007bff;'>";
    foreach ($opciones as $opcion) {
        echo "<option value='$opcion'>$opcion</option>";
    }
    echo "</select>";
}

function mostrarOpcionesLaboratorios($conn)
{
    $opciones = obtenerOpcionesCombo($conn, "laboratorios");
    // Mostrar las opciones en un combo box
    echo "<select name='nombre_laboratorio'>";
    foreach ($opciones as $opcion) {
        echo "<option value='$opcion'>$opcion</option>";
    }
    echo "</select>";
}


?>
