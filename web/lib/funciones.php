<?php

function conectarBD() { #Aquí estamos haciendo la tarea repetitiva que estabamos haciendo en todos los archivos que queríamos conectar a la BD
    $conexion = mysqli_connect("localhost", "root", "", "proyectoEntornos");
    if (!$conexion) {
        die("Error de connexió: " . mysqli_connect_error());
    }
    return $conexion;
}

?>
